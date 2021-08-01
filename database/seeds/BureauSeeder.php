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
                'Bureau' => 'AKBPB',
                'subcity' => 'Akakikality',
            ],
            [
                'Bureau' => 'ABPB',
                'subcity' => 'Arada',
            ],
            [
                'Bureau' => 'BBPB',
                'subcity' => 'Bole',
            ],
            [
                'Bureau' => 'GBPB',
                'subcity' => 'Gullele',
            ],
            [
                'Bureau' => 'KBPB',
                'subcity' => 'Kirkos',
            ],
            [
                'Bureau' => 'KKBPB',
                'subcity' => 'kolfekeranio',
            ],
            [
                'Bureau' => 'LKBPB',
                'subcity' => 'Lemi krau',
            ],
            [
                'Bureau' => 'KBPB',
                'subcity' => 'Lideta',
            ],
            [
                'Bureau' => 'NLBPB',
                'subcity' => 'Nifas silk-lafto',
            ],
            [
                'Bureau' => 'YBPB',
                'subcity' => 'Yeka',
            ],
        ]);
    }
}
