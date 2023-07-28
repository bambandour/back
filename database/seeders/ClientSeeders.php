<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::create([
            'nom' => 'Ndour',
            'prenom' => 'Cheikh Bamba',
            'telephone' => '772586360',
            'adresse' => 'Yoff, Dakar',
        ]);

        Client::create([
            'nom' => 'Ndiaye',
            'prenom' => 'May',
            'telephone' => '779875568',
            'adresse' => 'Yoff, Dakar',
        ]);

    }
}
