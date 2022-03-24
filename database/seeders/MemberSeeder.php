<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Member::create([
            'first_name'=>'Md. Rasel',
            'last_name'=>'Ahmed',
            'card_id'=>'5024-5254',
            'jamaat_id'=>1,
            'member_type'=>1,
            'gender'=>1,
        ]);
    }
}
