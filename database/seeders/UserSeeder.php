<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=new User([
            'number_id' => '1110288578',
            'name' => 'Santiago',
            'last_name' => 'Garcia',
            'email' => 'sg864387@gmail.com',
            'password' => '123456789',
            // 'password' => bcrypt(123456789),
            'remember_token' => Str::random(10),

        ]);
        $user->save();
        $user->assignRole('admin');
    }
}
