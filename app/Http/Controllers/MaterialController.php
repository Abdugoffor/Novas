<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterialCreateRequest;
use App\Http\Requests\MaterialRequest;
use App\Http\Requests\MaterialShearRequest;
use App\Models\Invoice;
use App\Models\Material;
use App\Models\MaterialCategory;
use App\Models\MaterialStok;
use App\Models\MaterialStokValue;
use App\Models\Transfer;
use App\Models\Unit;
use Illuminate\Http\Request;
use Termwind\Components\Raw;

class MaterialController extends Controller
{
    public function index()
    {
        // $user = auth()->user();
        $models = Material::all();
        return view('material.index', ['models' => $models]);
    }
    public function store(MaterialRequest $request)
    {
        Material::create($request->all());
        return redirect()->back()->with('text', 'Информация введена');
    }
    public function update(MaterialRequest $request, Material $material)
    {
        $material->update($request->all());
        return redirect()->back()->with('text', 'Информация была изменена');
    }
    public function delete(Material $material)
    {
        $material->delete();
        return redirect()->back()->with('text', 'Информация удалены');
    }
}
