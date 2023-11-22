<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentCreateRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $models = Department::all();
        return view('departments.index', ['models' => $models]);
    }
    public function store(DepartmentCreateRequest $request)
    {
        Department::create($request->all());
        return redirect()->back()->with('text', 'Информация введена');
    }
    public function update(DepartmentCreateRequest $request, Department $department)
    {
        // dd($request->all(), $department);
        $department->update($request->all());
        return redirect()->back()->with('text', 'Информация была изменена');
    }
    public function delete(Department  $department)
    {
        // dd($department);
        $department->delete();
        return redirect()->back()->with('text', 'Информация удалены');
    }
}
