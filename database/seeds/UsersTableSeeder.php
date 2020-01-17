<?php

use App\Entities\Role;
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
                'full_name' => 'Admin',
                'username'   => 'admin',
                'email'      => 'admin@gmail.com',
                'password'   => bcrypt('123123'),
                'role_id'    => Role::$roles['Admin']
            ],
            [
                'full_name' => 'Ong Van Phat',
                'username'   => 'ovpdng124',
                'email'      => 'ongvanphat124@gmail.com',
                'password'   => bcrypt('123123'),
                'role_id'    => Role::$roles['Guest']
            ],
            [
                'full_name' => 'Nguyen Minh Nhat',
                'username'   => 'nhatnm',
                'email'      => 'nguyenminhnhatdn91@gmail.com',
                'password'   => bcrypt('123123'),
                'role_id'    => Role::$roles['Guest']
            ]
        ]);
    }
}
