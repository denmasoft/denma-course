<?php

namespace App\Exports;

//use App\User;
use App\Entities\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return User::all();
	return User::orderBy('surname', 'ASC')->paginate(25);
    }
}
