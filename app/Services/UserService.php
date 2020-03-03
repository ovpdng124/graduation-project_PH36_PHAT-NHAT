<?php

namespace App\Services;

use App\Entities\User;
use App\Filters\UserFilter;
use App\Mail\VerifyMail;
use Carbon\Carbon;
use Mail;

class UserService
{
    protected $userFilter;

    public function __construct()
    {
        $this->userFilter = app(UserFilter::class);
    }

    public function getUsers($limits, $search, $searchKey)
    {
        $query = User::query();

        if (!empty($search) && !empty($searchKey)) {
            $query = $this->userFilter->search($query, $search, $searchKey);
        }

        $query = $query->with('role')->orderByDesc('created_at')->paginate($limits);

        return $query;
    }

    public function store($params)
    {
        $params['password']     = bcrypt($params['password']);
        $params['verify_token'] = $this->encodeToken($params);

        if (!User::create($params)) {
            return [false, 'Create failed!'];
        }

        $this->sendMail($params['verify_token']);

        return [true, 'Create success'];
    }

    public function sendMail($token)
    {
        $user = User::where('verify_token', '=', $token)->first();

        return Mail::to($user->email)->send(new VerifyMail($user));
    }

    public function encodeToken($params)
    {
        return base64_encode($params['email']) . '.' . base64_encode(now());
    }

    public function decodeToken($params)
    {
        $tokenExplode = explode('.', $params['verify_token']);
        $email        = base64_decode($tokenExplode[0]);
        $dateTime     = base64_decode($tokenExplode[1]);

        $dateTimeCovert  = Carbon::parse($dateTime);
        $expired = (now()->timestamp - $dateTimeCovert->timestamp) < 172800;

        if (!$expired) {
            $user                   = User::where('email', '=', $email)->first();
            $newToken               = $this->encodeToken($params);
            $params['email']        = $email;
            $params['verify_token'] = $newToken;

            $user->update($params);
            $this->sendMail($newToken);

            return false;
        }

        $params['verify_at'] = now();

        $user = User::where('email', '=', $email)->first();

        $user->update($params);

        return true;
    }
}
