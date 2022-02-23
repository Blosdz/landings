<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $user = User::create([
          'name'      => 'Apselom',
          'email'     => 'administrador@yopmail.com',
          'password'  => Hash::make('12345678'),
          'rol'      => 1,
        ]);
        Profile::truncate();
        
         Profile::create([
          'first_name'         => 'admin',
          'type_document'      => 'dni',
          'country'            => 'peru',
          'user_id'                => $user->id,
        ]);
    }
}
