<?php

namespace App\Services;

use App\Entities\User;
use App\Filters\UserFilter;
use App\Helpers\GlobalHelper;
use App\Mail\VerifyMail;
use Exception;
use Mail;
use Auth;
use Hash;
use Log;

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

        return User::create($params);
    }

    public function updateIfChangedMail($params, $user)
    {
        $params['verify_at']    = null;
        $params['verify_token'] = $this->encodeToken($params);

        return $user->update($params);
    }

    public function sendMail($email)
    {
        $user = User::where('email', $email)->first();

        try {
            Mail::to($user->email)->send(new VerifyMail($user));

            return true;
        } catch (Exception $exception) {
            Log::error($exception);

            return false;
        }
    }

    public function encodeToken($params)
    {
        return base64_encode($params['email']) . '.' . base64_encode(now());
    }

    public function decodeToken($verify_token)
    {
        $tokenExplode = explode('.', $verify_token);
        $email        = base64_decode($tokenExplode[0]);
        $dateTime     = base64_decode($tokenExplode[1]);

        return [$email, $dateTime];
    }

    public function verifyAccount($email, $dateTime)
    {
        $expired = GlobalHelper::checkExpiredDate($dateTime, 2);
        $user    = User::where('email', $email)->first();

        if ($expired) {
            $params['email']        = $email;
            $newToken               = $this->encodeToken($params);
            $params['verify_token'] = $newToken;

            $user->update($params);
            $this->sendMail($email);

            return false;
        }

        $params['verify_at'] = now();

        $user->update($params);

        return true;
    }

    public function updatePasswordProfile($params)
    {
        $user = Auth::user();

        if (Hash::check($params['current_password'], $user->getAuthPassword())) {
            $newPassword = [
                'password' => bcrypt($params['new_password']),
            ];

            $user->update($newPassword);

            return true;
        }

        return false;
    }
}
