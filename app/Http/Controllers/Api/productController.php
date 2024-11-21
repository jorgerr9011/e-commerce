<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Log;

// El ORM de Laravel es Eloquent

/*
    $users = User::all(); -> Retorna todos los usuarios del sistema.

    $users = User::where('age', 18) -> Solo devolverá usuarios con edad = 18

    $users = User::where('age', '>=', 18) -> Solo devolverá usuarios con edad >= 18

    $users = User::where('age', '>=', 18)->where('zip_code', 2902) ---> Tambien se pueden encadenar condiciones con '->' 

    Otro ejemplo: 

        $users = User::where('age', '>=', 18)->orWhere('zip_code', 123);

    Además, es importante que al final de la directiva se indique un 'get', para 
    traernos los datos de la siguiente manera: 

        $users = User::where('age', '>=', 18)->get();

    Una directiva para ordenar los datos:  

        $users = User::where('age', '>=', 18)->orderBy('age', 'asc')->get();

    Se podría establecer un límite al traernos datos (por ejemplo, solo traer 5): 

        $users = User::where('age', '>=', 18)->limit(5)->get();

    También podría limitar a 5, pero saltarse los 10 primeros (lo que es un offset):

        $users = User::where('age', '>=', 18)->limit(5, 10)->get();

    Si queremos traernos solo uno (el primero):

        $users = User::where('age', '>=', 18)->first();

    Si solo 1 y búsqueda por id:  

        $users = User::find(1);

    EN CASO DE QUE QUISIERAMOS HACER CONSULTAS RAW (hay que importar clase DB): 

        $age = 30;
        $users = DB::select( DB::raw("SELECT * FROM users WHERE age='$age' ") );

    EN CASO DE QUE QUISIERAMOS CREAR EN VEZ DE CONSULTAR:  

        DB::insert( DB::raw("INSERT INTO users VALUE ... ") );
    */

class productController extends Controller
{

    public function productIndex()
    {
        $products = Product::all();

        /*
            En vez de ["products" => $products], podemos
            pasarle el método compact($products), que haría 
            lo mismo.
        */
        return view('product.pruebaController', ["products" => $products]);
    }

    public function find()
    {
        $products = Product::all();

        $data = [
            'products' => $products,
            'status' => 200
        ];

        /*
            El uso de Log está muy bien, porque permite printear datos como
            en otros lenguajes, y estos valores irán dirigidos a app\storage\logs
            y al final de todo se podrán visualizar.

            Log::info($products);
        */
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
