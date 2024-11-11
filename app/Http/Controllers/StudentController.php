<?php

namespace App\Http\Controllers;

use App\Exports\StudentsExport;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function show()
    {
        $students = Student::all();
        return view('index', compact('students'));  // Reference directly to 'index'
    }

    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required|string|max:255',
    'email' => 'required|email|max:255',
    'age' => 'required|integer|min:1',
        ]);

        Student::create($request->all());
        return redirect()->route('index')->with('success', 'Student created successfully.');
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
           'name' => 'required|string|max:255',
    'email' => 'required|email|max:255',
    'age' => 'required|integer|min:1',
        ]);

        $student->update($request->all());
        return redirect()->route('index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('index')->with('success', 'Student deleted successfully.');
    }

    public function export()
    {
        return Excel::download(new StudentsExport, 'students.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function create()
    {
        return view('index');  // Display the same index view for creating a student
    }

    public function edit(Student $student)
    {
        $students = Student::all();
        return view('index', compact('students', 'student'));  // Pass student to edit in the same index view
    }
}
