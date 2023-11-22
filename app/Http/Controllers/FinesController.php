<?php

namespace App\Http\Controllers;

use App\Http\Requests\FinesStoreRequest;
use App\Models\Fines;
use App\Models\Salary;
use Illuminate\Http\Request;

class FinesController extends Controller
{
    public function store(FinesStoreRequest $finesStoreRequest)
    {
        // dd($finesStoreRequest->all());
        $year = date('Y', strtotime($finesStoreRequest->date));
        $month = date('m', strtotime($finesStoreRequest->date));

        $salary = Salary::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->where('staf_id', $finesStoreRequest->staf_id)
            ->first();
        if ($salary) {

            Fines::create([
                'salary_id' => $salary->id,
                'date' => $finesStoreRequest->date,
                'valeu' => $finesStoreRequest->summa,
                'comment' => $finesStoreRequest->comment,
            ]);
            return redirect()->back()->with('text', 'Информация введена');
        } else {

            $salary = Salary::create([
                'staf_id' => $finesStoreRequest->staf_id,
                'date' => $finesStoreRequest->date,
            ]);
            Fines::create([
                'salary_id' => $salary->id,
                'date' => $finesStoreRequest->date,
                'valeu' => $finesStoreRequest->summa,
                'comment' => $finesStoreRequest->comment,
            ]);
            return redirect()->back()->with('text', 'Информация введена');
        }
    }
}
