<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\BookSelf;
use App\Models\Jamaat;
use App\Models\Language;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(JamaatSeeder::class);
        $this->call(BloodGroupSeeder::class);

        User::create([
            'name'=> 'Admin',
            'email'=>'admin@mail.com',
            'password'=> Hash::make('12345678')
        ]);

        Language::create(['name'=>'Bangla']);
        Jamaat::create(['Name'=>'Meshkat']);
        Author::create(['Name'=>'Ashraf Ali Thanwi']);
        Subject::create(['Name'=>'Bangla']);
        BookSelf::create(['Title'=>'Self 1','location'=>'Beside Moshjid','capacity'=>200]);
    }
}
