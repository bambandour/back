<?php

namespace Database\Seeders;

use App\Models\Compte;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompteSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Compte::create([
            'operateur'=>'Orange Money',
            'numero_compte' => 'OM_772586360', 
            'solde' => 10000,
            'client_id' => 1
        ]);
        Compte::create([
            'operateur'=>'Orange Money',
            'numero_compte' => 'OM_779875568', 
            'solde' => 5000,
            'client_id' => 2
        ]);

    }
}
