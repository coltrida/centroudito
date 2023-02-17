<?php

namespace Database\Seeders;

use App\Models\Medico;
use Illuminate\Database\Seeder;
use DB;

class MedicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Medico::insert([
            [
                'cognome' => 'SCARAMUZZINO',
                'nome' => 'MANELA',
            ],
            [
                'cognome' => 'FATTORI',
                'nome' => 'BRUNO',
            ],
            [
                'cognome' => 'MAGGI',
                'nome' => 'DUILIO',
            ],
            [
                'cognome' => 'FIACCHINI',
                'nome' => 'GIACOMO',
            ],
            [
                'cognome' => 'SUGLIA',
                'nome' => 'MIMMO',
            ],
            [
                'cognome' => 'NOTTOLI',
                'nome' => 'STEFANIA',
            ],
            [
                'cognome' => 'MARSALLI',
                'nome' => 'GIULIA',
            ],
            [
                'cognome' => 'DURSO',
                'nome' => 'DOMENICO',
            ],
            [
                'cognome' => 'CIABATTONI',
                'nome' => 'ANDREA',
            ],
        ]);

        $medici = Medico::all();
        foreach ($medici as $medico){
            $medico->cod = 'M'.$medico->id;
            $medico->save();
        }

        DB::table('medico_user')->insert([
            [
                'medico_id' => 1,
                'user_id' => 2,
            ],
            [
                'medico_id' => 2,
                'user_id' => 2,
            ],
            [
                'medico_id' => 3,
                'user_id' => 2,
            ],
            [
                'medico_id' => 4,
                'user_id' => 2,
            ],
            [
                'medico_id' => 5,
                'user_id' => 2,
            ],
            [
                'medico_id' => 6,
                'user_id' => 2,
            ],
            [
                'medico_id' => 7,
                'user_id' => 2,
            ],
            [
                'medico_id' => 8,
                'user_id' => 9,
            ],
            [
                'medico_id' => 9,
                'user_id' => 12,
            ],

        ]);
    }
}
