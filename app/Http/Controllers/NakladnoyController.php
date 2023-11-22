<?php

namespace App\Http\Controllers;

use App\Models\Nakladnoy;
use Illuminate\Http\Request;

class NakladnoyController extends Controller
{
    public function index()
    {
        $models = Nakladnoy::all();
        return view('nakladnoy.index', ['models' => $models]);
    }
    public function view(Nakladnoy $nakladnoy)
    {
        return view('nakladnoy.show', ['model' => $nakladnoy]);
    }
}
