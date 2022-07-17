<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Find One
     */
    public function get($id)
    {
        $array = ['error' => ''];

        $product = Products::join('brands', 'brands.id', '=', 'products.brand_id')->get(['products.*', 'brands.name as brand'])->find($id);

        if ($product) {
            $array['get'] = $product;
        } else {
            $array['error'] = "Nenhum produto encontrado!";
        }

        return $array;
    }
    /**
     * list products
     */
    public function list()
    {
        $array = ['error' => ''];

        $list = Products::join('brands', 'brands.id', '=', 'products.brand_id')->get(['products.*', 'brands.name as brand']);

        if (count($list) > 0) {
            $array['list'] = $list;
        } else {
            $array['error'] = "Nenhum produto encontrado!";
        }

        return $array;
    }
    /**
     * create
     */
    public function create(Request $request)
    {
        $array = ['error' => ''];

        // Validando
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|min:10',
            'voltage' => 'required|min:3',
            'brand_id' => 'required|min:1'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }

        // Criando o registro
        $product = new Products();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->voltage = $request->input('voltage');
        $product->brand_id = $request->input('brand_id');
        $product->save();

        return $array;
    }
    /**
     * update
     */
    public function update($id, Request $request)
    {
        $array = ['error' => ''];
        // Validando
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|min:10',
            'voltage' => 'required|min:3',
            'brand_id' => 'required|min:1'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }

        $product = Products::find($id);
        if($product) {
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->voltage = $request->input('voltage');
            $product->brand_id = $request->input('brand_id');

            $product->save();
        } else {
            $array['error'] = 'Produto '.$id.' não existe, logo, não pode ser atualizado.';
        }

        return $array;
    }

    public function delete($id) {
        $array = ['error' => ''];

        $product = Products::find($id);
        if ($product) {
            $product->delete();
        } else {
            $array['error'] = 'Produto '.$id.' não existe, logo, não pode ser deletado.';
        }

        return $array;
    }
}
