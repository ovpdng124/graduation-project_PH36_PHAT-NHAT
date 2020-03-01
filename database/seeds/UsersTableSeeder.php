<?php

use App\Entities\Role;
use App\Entities\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'full_name'    => 'Admin',
                'username'     => 'admin',
                'email'        => 'admin@gmail.com',
                'password'     => bcrypt('123123'),
                'role_id'      => Role::$roles['Admin'],
                'address'      => '123 Admin street',
                'phone_number' => '0905678902',
                'verify_token' => base64_decode('admin@gmail.com'). '.' . base64_encode(now()),
            ],
            [
                'full_name'    => 'Ong Van Phat',
                'username'     => 'ovpdng124',
                'email'        => 'ongvanphat124@gmail.com',
                'password'     => bcrypt('123123'),
                'role_id'      => Role::$roles['User'],
                'address'      => '324 Ha Huy Tap, Hoa Khe, Thanh Khe, Da Nang',
                'phone_number' => '0905671240',
                'verify_token' => base64_decode('ongvanphat124@gmail.com'). '.' . base64_encode(now()),
            ],
            [
                'full_name'    => 'Nguyen Minh Nhat',
                'username'     => 'nhatnm',
                'email'        => 'nguyenminhnhatdn91@gmail.com',
                'password'     => bcrypt('123123'),
                'role_id'      => Role::$roles['User'],
                'address'      => '294 Nguyen Thien Ke, Binh Hien, Son Tra, Da Nang ',
                'phone_number' => '0902945284',
                'verify_token' => base64_decode('nguyenminhnhatdn91@gmail.com'). '.' . base64_encode(now()),
            ],
        ]);
    }
}
