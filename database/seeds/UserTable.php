<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment() === 'production') {
            exit('I just stopped you getting fired. Love, Amo.');
        }
        DB::table('users')->truncate();
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "user$i",
                'email' => "email$i@gmail.com",
                'password' => bcrypt('123456'),
                'role_id' => $i,
            ]);
        }
    }
}
