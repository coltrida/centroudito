<?php

namespace Database\Seeders;

use App\Models\ProductProva;
use Illuminate\Database\Seeder;

class ProductProvaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductProva::insert([
            [
                'prova_id' => 1,
                'product_id' => 5,
                'orecchio' => 'sx',
                'prezzo' => 1200,
            ],
            [
                'prova_id' => 1,
                'product_id' => 6,
                'orecchio' => 'dx',
                'prezzo' => 1200,
            ],
            [
                'prova_id' => 2,
                'product_id' => 7,
                'orecchio' => 'sx',
                'prezzo' => 2000,
            ],
            [
                'prova_id' => 2,
                'product_id' => 8,
                'orecchio' => 'dx',
                'prezzo' => 2000,
            ],
            [
                'prova_id' => 3,
                'product_id' => 9,
                'orecchio' => 'sx',
                'prezzo' => 2000,
            ],
            [
                'prova_id' => 3,
                'product_id' => 10,
                'orecchio' => 'dx',
                'prezzo' => 2000,
            ],
        ]);
    }
}
