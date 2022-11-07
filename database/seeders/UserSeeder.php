<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
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
          'email_verified_at' => Carbon::now(),
          'validated' => 1,
          'rol'      => 1,
        ]);

        $gestor = User::create([
          'name'      => 'Gestor',
          'email'     => 'gestor@yopmail.com',
          'password'  => Hash::make('12345678'),
          'email_verified_at' => Carbon::now(),
          'validated' => 1,
          'rol'      => 5,
        ]);

        $verificator = User::create([
          'name'      => 'Verificador',
          'email'     => 'verificador@yopmail.com',
          'email_verified_at' => Carbon::now(),
          'password'  => Hash::make('12345678'),
          'validated' => 1,
          'rol'      => 6,
        ]);
        Profile::truncate();
        
        Profile::create([
          'first_name'         => 'admin',
          'type_document'      => 'dni',
          'country'            => 'peru',
          'user_id'                => $user->id,
        ]);

        Profile::create([
          'first_name'         => 'Gestor',
          'type_document'      => 'dni',
          'country'            => 'peru',
          'user_id'                => $gestor->id,
        ]);

        Profile::create([
          'first_name'         => 'Verificador',
          'type_document'      => 'dni',
          'country'            => 'peru',
          'user_id'                => $verificator->id,
        ]);
    }
}
