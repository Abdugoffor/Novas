<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalaryCreateRequest;
use App\Models\Salary;
use App\Models\Salary_Type;
use App\Models\Salary_Type_Value;
use App\Models\Staf;
use App\Models\Type;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index()
    {
        // dd('123');
        $models = Salary::all();
        $stafs = Staf::all();
        $salaryType = Type::all();
        $ab = Salary_Type_Value::all();
        return view('salary.index', ['models' => $models, 'stafs' => $stafs, 'salaryTypes' => $salaryType]);
    }
    public function store(SalaryCreateRequest $request)
    {
        // dd($request->all());
        $year = date('Y', strtotime($request->date));
        $month = date('m', strtotime($request->date));

        $salary = Salary::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->where('staf_id', $request->staf_id)
            ->first();
            
        if ($salary) {
            $salaryType = Salary_Type_Value::create([
                'salary_id' => $salary->id,
                'type_id' => $request->type_id,
                'value' => $request->summa,
            ]);
            return redirect()->back()->with('text', 'Информация введена');
        } else {

            $salary = Salary::create([
                'staf_id' => $request->staf_id,
                'date' => $request->date,
            ]);
            $salaryType = Salary_Type_Value::create([
                'salary_id' => $salary->id,
                'type_id' => $request->type_id,
                'value' => $request->summa,
            ]);
            return redirect()->back()->with('text', 'Информация введена');
        }
    }
}
