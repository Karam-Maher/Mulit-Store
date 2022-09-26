<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth:sanctum')->except('index','show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Product::filter($request->query())
        ->with('category:id,name','store:id,name','tags:id,name')
        ->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' =>'nullable|string|max:255',
            'category_id' =>'required|exists:categories,id',
            'status' =>'in:active,inactive',
            'price' =>'required|numeric|min:0',
            'compare_price' =>'nullable|numeric|gt:price',
        ]);
        $user = $request->user();
        if(!$user->tokenCan('products.create')){
            abort(403,' not allowed');
        }

        $product = Product::create($request->all());
        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product->load('category:id,name','store:id,name','tags:id,name');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' =>'nullable|string|max:255',
            'category_id' =>'sometimes|required|exists:categories,id',
            'status' =>'in:active,inactive',
            'price' =>'sometimes|required|numeric|min:0',
            'compare_price' =>'nullable|numeric|gt:price',
        ]);
        $user = $request->user();
        if(!$user->tokenCan('products.update')){
            abort(403,' not allowed');
        }


        $product->update($request->all());
        return Response::json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        $user = Auth::guard('sanctum')->user();
        if(!$user->tokenCan('products.delete')){
            return response([
                'message' => 'not Allowed'
            ],403);
        }
        return [
            'message' => 'Product deleted successfuly',
        ];
    }
}
