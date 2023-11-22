<?php

namespace App\Http\Controllers;

use App\Http\Requests\StafRequest;
use App\Http\Requests\StafUpdateRequest;
use App\Models\Department;
use App\Models\Equipment;
use App\Models\Salary_Type;
use App\Models\Staf;
use Illuminate\Http\Request;

class StafController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Staf::all();
        $salarys = Salary_Type::all();
        $departments = Department::all();
        $equipment = Equipment::all();
        return view('staf.index', ['models' => $models, 'departments' => $departments, 'salarys' => $salarys, 'equipment' => $equipment]);
    }

    public function store(StafRequest $request)
    {
        $date = $request->all();
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $extensions = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extensions;
            $file->move('file_uploded/', $filename);
            $date['file'] = 'file_uploded/' . $filename;
        }

        if ($request->hasfile('img')) {
            $file = $request->file('img');
            $extensions = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extensions;
            $file->move('img_uploded/', $filename);
            $date['img'] = 'img_uploded/' . $filename;
        }

        Staf::create($date);
        return redirect()->back()->with('text', 'Информация введена');
    }

    public function show(Staf $staf)
    {
        $equipments = Equipment::all();
        return view('staf.show', ['staf' => $staf, 'equipments' => $equipments]);
    }


    public function update(StafUpdateRequest $request, Staf $staf)
    {
        $date = $request->all();
        // dd($date);
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $extensions = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extensions;
            $file->move('file_uploded/', $filename);
            $date['file'] = 'file_uploded/' . $filename;
        }

        if ($request->hasfile('img')) {
            $file = $request->file('img');
            $extensions = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extensions;
            $file->move('img_uploded/', $filename);
            $date['img'] = 'img_uploded/' . $filename;
        }

        $staf->update($date);
        return redirect()->back()->with('text', 'Информация была изменена');
    }

    public function delete(Staf $staf)
    {
        $staf->delete();
        return redirect()->back()->with('text', 'Информация удалены');
    }

    public function add_equipment(Request $request, Staf $staf)
    {
        $request->validate([
            'equipments' => 'array'
        ]);
        $staf->equipments()->sync($request->equipments);

        return redirect()->back()->with('text', 'Информация введена');
    }
    // public function equipment_delete(Staf $staf, $id)
    // {
    //     $staf->equipments()->detach($id);
    //     return redirect()->back()->with('text', 'Информация удалены');
    // }
}
