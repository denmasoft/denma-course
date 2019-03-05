<?php

namespace App\Http\Controllers;
use Validator;
use App\Entities\Specialty;
use App\Entities\Grade;

use Illuminate\Http\Request;

class StudyController extends Controller
{
    public function specialties(Request $request, $id)
    {
        $grade = Grade::findorFail($id);

        return view('grade.specialties')->with(['specialties' => $grade->Specialties]);
    }
}
