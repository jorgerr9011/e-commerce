<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class productController extends Controller
{

    public function find()
    {
        $products = Product::all();

        $data = [
            'products' => $products,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function save(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'details' => 'required',
            'price' => 'required',
            'discounts' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        $product = Product::create([
            'name' => $request->name,
            'details' => $request->details,
            'price' => $request->price,
            'discounts' => $request->discounts
        ]);

        if (!$product) {
            $data = [
                'message' => 'Error creating product',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'product' => $product,
            'status' => 201
        ];

        return response()->json($data, 200);
    }

    public function findById($id) 
    {
        $product = Product::find($id);

        if (!$product) {
            $data = [
                'message' => 'Product dont found',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $data = [
            'product' => $product,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function deleteById($id)
    {
        $product = Product::find($id);

        if (!$product) {
            $data = [
                'message' => 'Product dont found',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $product->delete();

        $data = [
            'message' => 'Product deleted',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updateById(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            $data = [
                'message' => '',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'details' => 'required',
            'price' => 'required',
            'discounts' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        $product->name = $request->name;
        $product->details = $request->details;
        $product->price = $request->price;
        $product->discounts = $request->discounts;

        $product->save();

        $data = [
            'message' => 'Product updated',
            'product' => $product,
            'status' => 200
        ];

        return response()->json($product, 200);
    }
}
