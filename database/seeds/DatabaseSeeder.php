<?php

use Illuminate\Database\Seeder;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(User::class)->create(
            [
                'email' => 'user1@gmail.com',
                'name' => 'user1',
                'password' => bcrypt(1111)
            ]
        );
        factory(User::class)->create(
            [
                'email' => 'tom@gmail.com',
                'name' => 'tom',
                'password' => bcrypt(1111)
            ]
        );
        factory(User::class)->create(
            [
                'email' => 'kyle@gmail.com',
                'name' => 'kyle',
                'password' => bcrypt(1111)
            ]
        );
    }
}
