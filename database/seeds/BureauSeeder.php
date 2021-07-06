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
        $bureau = new Bureau();
        $bureau->Bureau = "ABPB";
        $bureau->subcity = "Arada";
        $bureau->save();
    }
}
