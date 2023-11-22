<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductModelCreateRequest;
use App\Models\ModelImage;
use App\Models\ModelProduct;
use App\Models\ProductModel;
use App\Models\ProductModelImage;
use Illuminate\Http\Request;

class ProductModelController extends Controller
{
    public function index()
    {
        $models = ModelProduct::all();
        // return $models;
        return view('productmodels.index', ['models' => $models]);
    }
    public function store(ProductModelCreateRequest $request)
    {
        // dd($request->all());

        $imgs = $request->imgs;

        $productModel = ModelProduct::create([
            'name_size' => $request->name_size,
            'size' => $request->size,
        ]);

        if ($imgs) {

            foreach ($imgs as $img) {
                if ($img->isValid()) {
                    $file = $img;
                    $a = rand(1, 3000);
                    $extensions = $file->getClientOriginalExtension();
                    $filename = time() . $a . '.' . $extensions;
                    $file->move('test/', $filename);
                    $date['img'] = 'test/' . $filename;
                    ModelImage::create([
                        'model_product_id' => $productModel->id,
                        'img' => $date['img'],
                    ]);
                }
            }
        }
        return redirect()->back()->with('text', 'Информация введена');
    }
    // Updateni kami bor
    public function update(ProductModelCreateRequest $request, ModelProduct $product_model)
    {
        // dd($request->imgs, $product_model);

        $imgs = $request->imgs;

        $product_model->update([
            'name' => $request->name,
            'size' => $request->size,
            'consumption_rate' => $request->consumption_rate,
        ]);
        $date = [];
        if ($imgs) {
            foreach ($imgs as $img) {
                if ($img->isValid()) {
                    $file = $img;
                    $a = rand(1, 3000);
                    $extensions = $file->getClientOriginalExtension();
                    $filename = time() . $a . '.' . $extensions;
                    $file->move('test/', $filename);
                    $date[] = 'test/' . $filename;
                }
            }
            $product_model->product_models_images()->update($date);
            
        }
        return redirect()->back()->with('text', 'Информация введена');
    }

    public function delete(ModelProduct $product_model)
    {
        $product_model->delete();
        return redirect()->back()->with('text', 'Информация удалены');
    }
}
