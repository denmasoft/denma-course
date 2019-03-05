<?php

namespace App\Http\Controllers;
use Validator;
use App\Entities\Province;

use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function concellos(Request $request, $id)
    {
        $province = Province::findorFail($id);
        $concellos = $province->concellos;
        return view('province.concellos')->with(['concellos' => $concellos]);
    }
}
