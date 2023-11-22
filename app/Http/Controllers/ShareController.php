<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Material;
use App\Models\MaterialStok;
use App\Models\MaterialStokValue;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function index(Request $request)
    {
        $model = MaterialStokValue::findorfail($request->material_stok_value);
        // dd($model, $request->all());
        if ($model->quantity >= $request->quantity) {

            Log::create([
                'type' => 2,
                'increment' => 2,
                'material_id' => $model->material_id,
                'quantity' => $request->quantity,
                'went' => $model->quantity,
                'remained' => ($model->quantity - $request->quantity),
                'from_id' => $model->material_stok_id,
                'to_id' => $request->to_id,
            ]);
            $model->update([
                'quantity' => ($model->quantity - $request->quantity)
            ]);

            $material_stok_value = MaterialStokValue::where('material_stok_id', $request->to_id)->where('material_id', $model->material_id)->first();

            if ($material_stok_value) {
                $material_stok_value->update([
                    'quantity' => $material_stok_value->quantity + $request->quantity,
                ]);
            } else {
                MaterialStokValue::create([
                    'material_stok_id' => $request->to_id,
                    'material_id' => $model->material_id,
                    'unit' => $model->unit,
                    'quantity' => $request->quantity,
                ]);
            }
            return redirect()->back()->with('text', 'Информация введена');
        }
        return redirect()->back()->with('text', 'Значение не должно быть больше ' . $model->quantity);
    }
}
