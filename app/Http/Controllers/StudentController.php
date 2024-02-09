<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $students=Student::all();
        return $students;
    }
    public function store(StoreRequest $request)
    {
        $res=Student::create($request->validated());
        return $res;
    }
}
