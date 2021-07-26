<?php

use App\Bureau;
use Illuminate\Database\Seeder;

class BureauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bureaus')->insert([
            [
                'Bureau'=>'ABPB',
                'subcity'=>'Arada',
            ],
            [
                'Bureau'=>'YBPB',
                'subcity'=>'Yeka',
            ],

        ]);
    }
}
