<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Student::all(['id','name','email','age']);
    }
    public function heading(): array{
        return['ID','Name','Email','Age'];
    }
}
