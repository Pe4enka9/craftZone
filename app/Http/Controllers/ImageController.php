<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    // Загрузка изображений
    public function store(Request $request, Product $product): JsonResponse
    {
        $validated = $request->validate([
            'images' => ['required', 'array'],
            'images.*' => ['image', 'mimes:jpeg,jpg,png', 'max:2048'],
        ]);

        $uploadedImages = [];

        foreach ($validated['images'] as $image) {
            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('products', $fileName, 'public');

            $imageModel = Image::create([
                'url' => $path,
                'product_id' => $product->id,
            ]);

            $uploadedImages[] = [
                'id' => $imageModel->id,
                'url' => $imageModel->url,
                'is_main' => $imageModel->is_main,
            ];
        }

        return response()->json([
            'images' => $uploadedImages,
        ], 201);
    }

    // Установка основного изображения
    public function setMainImage(Product $product, Image $image): JsonResponse
    {
        $product->images()->update([
            'is_main' => false,
        ]);

        $image->update([
            'is_main' => true,
        ]);

        return response()->json([
            'image' => [
                'id' => $image->id,
                'url' => $image->url,
                'is_main' => $image->is_main,
            ],
        ]);
    }

    // Удаление изображения
    public function destroy(Product $product, Image $image): JsonResponse
    {
        if ($product->id !== $image->product_id) {
            return response()->json([], 404);
        }

        if (!Storage::disk('public')->exists($image->url)) {
            return response()->json([], 404);
        }

        Storage::disk('public')->delete($image->url);

        $image->delete();

        return response()->json(null, 204);
    }
}
