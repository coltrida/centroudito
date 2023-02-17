<?php

namespace Database\Seeders;

use App\Models\Marketing;
use Illuminate\Database\Seeder;

class MarketingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Marketing::insert([
            [
                'name' => 'GIORNALE',
                'cod' => 'G',
            ],
            [
                'name' => 'SCREENING',
                'cod' => 'S',
            ],
            [
                'name' => 'LETTERA',
                'cod' => 'L',
            ],
            [
                'name' => 'LISTA ESTERNA',
                'cod' => 'LE',
            ],
            [
                'name' => 'MEDICO',
                'cod' => 'M',
            ],
            [
                'name' => 'PASSAPAROLA',
                'cod' => 'P',
            ],
            [
                'name' => 'VETRINA',
                'cod' => 'V',
            ],
            [
                'name' => 'SOCIAL/WEB',
                'cod' => 'W',
            ],
            [
                'name' => 'RIACQUISTO',
                'cod' => 'R',
            ],
        ]);
    }
}
