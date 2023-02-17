<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            MaterialeSeeder::class,
            RuoloSeeder::class,
            MedicoSeeder::class,
            CategoriaSeeder::class,
            StatoApaSeeder::class,
            FilialeSeeder::class,
            UserSeeder::class,
            MarketingSeeder::class,
            FornitoreSeeder::class,
            ListinoSeeder::class,
            RecapitoSeeder::class,
            FilialeUserSeeder::class,
            //     ClientSeeder::class,
            BudgetSeeder::class,
            ProductSeeder::class,
            TipologiaSeeder::class,
            AgendaSeeder::class,
            FilialeListinoSeeder::class,
            //         AppuntamentoSeeder::class,
            //         TelefonateSeeder::class
            //         ProvaSeeder::class,
            //        ProductProvaSeeder::class,
            //         FatturaSeeder::class
        ]);

        //dd(Storage::disk('public')->exists('/documenti/59/'));

        Storage::disk('public')->deleteDirectory('/documenti/');
        Storage::disk('public')->deleteDirectory('/fatture/');
        Storage::disk('public')->deleteDirectory('/recapiti/');
        Storage::makeDirectory('/documenti');
        Storage::makeDirectory('/fatture/2023/');
        Storage::makeDirectory('/recapiti');
    }
}
