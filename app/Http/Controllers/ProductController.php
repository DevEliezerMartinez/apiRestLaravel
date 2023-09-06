<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
        //
        $product = Product::all();
        return $product;
    }
    public function AddProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:products',
            'description' => 'required|string|max:255',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }


        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');


        $product->save();


        return response()->json(['status' => 'created succesfully', 'product' => $product], 201);
    }
    public function modifyProduct(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:products,id',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        $product = Product::find($request->input('id'));



        $product->name = $request->input('name');
        $product->save();
        return response()->json(['status' => 'modified successfully', 'product' => $product],200);


    }
    public function deleteProduct(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:products,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        $product = Product::find($request->input('id'));


        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['status' => 'deleted successfully'],200);
    }
}