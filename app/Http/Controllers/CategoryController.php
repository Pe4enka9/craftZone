<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\Category\CategoryCollectionResource;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    // Создание категории
    public function store(CategoryRequest $request): JsonResponse
    {
        /** @var Category $category */
        $category = Category::create([
            'name' => $request->name,
        ]);

        return response()->json(new CategoryResource($category), 201);
    }

    // Получение списка категорий
    public function index(): JsonResponse
    {
        return response()->json(new CategoryCollectionResource(Category::paginate(10)));
    }

    // Получение одной категории
    public function show(Category $category): JsonResponse
    {
        return response()->json(new CategoryResource($category));
    }

    // Обновление категории
    public function update(CategoryRequest $request, Category $category): JsonResponse
    {
        $category->update([
            'name' => $request->name,
        ]);

        return response()->json(new CategoryResource($category));
    }

    // Удаление категории
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return response()->json(null, 204);
    }
}
