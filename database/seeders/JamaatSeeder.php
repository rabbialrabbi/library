<?php

namespace Database\Seeders;

use App\Models\Jamaat;
use Illuminate\Database\Seeder;

class JamaatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jamaat::create([
            'name' => 'Yash Dohom'
        ]);
    }
}
