<?php

namespace App\Http\Controllers\api;

use App\Bureau;
use App\Http\Controllers\Controller;
use App\Http\Resources\BureauResource;
use Illuminate\Http\Request;

class BureauController extends Controller
{
    public function allBureau(){
        $bureaus=Bureau::all();
        return BureauResource::collection($bureaus);
    }
}
