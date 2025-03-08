<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductCollectionResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Queries\ProductQuery;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Создание товара
    public function store(ProductRequest $request): JsonResponse
    {
        /** @var Product $product */
        $product = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
            'status_id' => 1,
            'seller_id' => $request->user()->id,
        ]);

        return response()->json(new ProductResource($product), 201);
    }

    // Получение списка товаров
    public function index(Request $request): JsonResponse
    {
        $products = (new ProductQuery())->filterByCategory($request->category)->paginate(10);

        return response()->json(new ProductCollectionResource($products));
    }

    // Получение одного товара
    public function show(Product $product): JsonResponse
    {
        return response()->json(new ProductResource($product));
    }
}
