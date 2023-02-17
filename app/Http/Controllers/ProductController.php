<?php

namespace App\Http\Controllers;

use App\Exceptions\ProductNotBelongsToThisUser;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
    }
    public function index()
    {
        return ProductCollection::collection(Product::paginate(10));
    }



    public function store(StoreProductRequest $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->discreption = $request->discreption;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->user_id = $request->user_id;
        $product->save();
        return response([
            "data" => new ProductResource($product), Response::HTTP_CREATED
        ]);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->checkuser($product);
        $product->update($request->all());
        return new ProductResource($product);
    }


    public function destroy(Product $product)
    {
        $this->checkuser($product);
        $product->delete();
        return response()->json("product deleted", Response::HTTP_OK);
    }

    public function checkuser(Product $product)
    {
        if (Auth::id() != $product->user_id) {
            throw new ProductNotBelongsToThisUser;
        }
    }
}