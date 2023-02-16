<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    
    public function index()
    {
        return ProductCollection::collection(Product::all());
    }


   
    public function store(StoreProductRequest $request)
    {
        //
    }

   
    public function show(Product $product)
    {
        return new ProductResource($product);
    }
   
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

   
    public function destroy(Product $product)
    {
        //
    }
}
