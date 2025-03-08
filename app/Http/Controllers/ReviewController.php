<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Http\Resources\Review\ReviewCollectionResource;
use App\Http\Resources\Review\ReviewResource;
use App\Models\Product;
use App\Models\Review;
use App\Queries\ProductQuery;
use Illuminate\Http\JsonResponse;

class ReviewController extends Controller
{
    // Добавление отзыва и рейтинга
    public function store(ReviewRequest $request, Product $product): JsonResponse
    {
        $review = Review::create([
            'rating' => $request->rating,
            'comment' => $request->comment,
            'user_id' => $request->user()->id,
            'product_id' => $product->id,
        ]);

        (new ProductQuery())->updateRating($product);

        return response()->json(new ReviewResource($review), 201);
    }

    // Получение отзывов товара
    public function index(Product $product): JsonResponse
    {
        return response()->json(new ReviewCollectionResource($product->reviews()->paginate(10)));
    }
}
