<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // app/Http/Controllers/EmployeeController.php
    public function index()
    {
        return view('employees.index', ['employees' => Employee::all()]);
    }
    
    public function store(Request $request)
    {

        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');

    }
    
    public function create()
    {
        return view('employees.create');

    }
    
    public function edit($id)
    {
        return response()->json(Employee::findOrFail($id));
    }
    
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|ends_with:@ohhbuddie.com',
        //     'phone' => 'required',
        //     'department' => 'required',
        //     'status' => 'required|in:Active,Inactive'
        // ]);
    
        $employee = Employee::findOrFail($id);
        $employee->update($request->only(['name', 'email', 'phone', 'department', 'status']));
    
        return response()->json(['success' => true]);
    }
    
    public function destroy($id)
    {
        Employee::destroy($id);
        return redirect()->route('employees.index')->with('success', 'Employee Deleted successfully.');
    }
}
