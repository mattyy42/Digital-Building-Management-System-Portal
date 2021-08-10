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
            'Bureau' => 'required'
        ]);
        $bureau=Bureau::create($data);
        return new BureauResource($bureau);
    }
    public function showBureau($id){
        $data=Bureau::findOrFail($id);
        return new BureauResource($data);
    }
    public function edit(Request $request){
        $data = $request->validate([
            'id'=>'required',
            'subcity' => 'required',
            'Bureau' => 'required'
        ]);
        $bureau=Bureau::findOrFail($request->id);
        $bureau->update($data);
        return new BureauResource($bureau);
    }
    public function delete($id)
    {
        $bureau=Bureau::findOrFail($id)->delete();
        return response()->json([
            'message'=>'Bureau is deleted successfully'
        ]);
    }
}
