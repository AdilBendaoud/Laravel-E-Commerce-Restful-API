<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ReviewResource;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index');
    }

    public function index(Product $product)
    {
        return ReviewResource::collection($product->reviews);
    }

    public function store(StoreReviewRequest $request, Product $product)
    {
        $review = new Review;
        $review->product_id = $product->id;
        $review->customer = Auth::user()->name;
        $review->review = $request->review;
        $review->star = $request->star;
        $review->save();
        $product->reviews()->save($review);
        return response()->json(["data" => $review], Response::HTTP_CREATED);
    }


    public function update(UpdateReviewRequest $request, Product $product, Review $review)
    {
        if (Auth::user()->name == $review->customer) {
            $review->update($request->all());
            return new ReviewResource($review);
        } else {
            return response()->json(["error" => "the review not belongs to user"], Response::HTTP_FORBIDDEN);
        }
    }


    public function destroy(Product $product, Review $review)
    {
        if (Auth::user()->name == $review->customer) {
            $review->delete();
            return response()->json(["status" => "review deleted"], Response::HTTP_ACCEPTED);
            ;
        } else {
            return response()->json(["error" => "the review not belongs to user"], Response::HTTP_FORBIDDEN);
        }
    }
}