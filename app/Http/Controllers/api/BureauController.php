<?php

namespace App\Http\Controllers\api;

use App\Bureau;
use App\Http\Controllers\Controller;
use App\Http\Resources\BureauResource;
use Illuminate\Http\Request;

class BureauController extends Controller
{
    public function allBureau()
    {
        $bureaus = Bureau::all();
        return BureauResource::collection($bureaus);
    }
    public function createBureau(Request $request)
    {
        $data = $request->validate([
            'subcity' => 'required',
            'bureau' => 'required'
        ]);
        $bureau=Bureau::create($data);
        return new BureauResource($bureau);
    }
}
