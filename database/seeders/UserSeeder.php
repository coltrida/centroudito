<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use function now;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => 'ADMIN',
                'email' => 'info@centrouditogroup.it',
                'ruolo_id' => 1,
                'budget_id' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Federico Cosseddu',
                'email' => 'federico.cosseddu@centrouditogroup.it',
                'ruolo' => 2,
                'budget_id' => 1,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Selene Caracciolo',
                'email' => 'selene.caracciolo@centrouditogroup.it',
                'ruolo' => 2,
                'budget_id' => 2,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Matteo Serra',
                'email' => 'matteo.serra@centrouditogroup.it',
                'ruolo' => 2,
                'budget_id' => 7,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Audio Firenze',
                'email' => 'audio.firenze@centrouditogroup.it',
                'ruolo' => 2,
                'budget_id' => 3,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Carlo Fabietti',
                'email' => 'carlo.fabietti@centrouditogroup.it',
                'ruolo' => 2,
                'budget_id' => 4,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Amm Toscana',
                'email' => 'toscana@centrouditogroup.it',
                'ruolo' => 3,
                'budget_id' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Liliana Cervone',
                'email' => 'liliana.cervone@centrouditogroup.it',
                'ruolo' => 2,
                'budget_id' => 6,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Athanasia Papatheodoru',
                'email' => 'athanasia.papatheodoru@centrouditogroup.it',
                'ruolo' => 2,
                'budget_id' => 5,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'call center',
                'email' => 'call@centrouditogroup.it',
                'ruolo' => 4,
                'budget_id' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Amm Marche',
                'email' => 'marche@centrouditogroup.it',
                'ruolo' => 3,
                'budget_id' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Audio Ascoli',
                'email' => 'audio.ascoli@centrouditogroup.it',
                'ruolo' => 2,
                'budget_id' => 8,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Roberto Paolini',
                'email' => 'roberto.paolini@centrouditogroup.it',
                'ruolo' => 2,
                'budget_id' => 9,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('123456'),
            ],

        ]);
    }
}
