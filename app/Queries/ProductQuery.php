<?php

namespace App\Queries;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Product
 */
class ProductQuery
{
    // Фильтрация товаров по категории
    public function filterByCategory($category): Builder
    {
        $query = Product::query();

        if ($category) {
            $query->where('category_id', $category);
        }

        return $query;
    }

    // Пересчет рейтинга товара
    public function updateRating(Product $product): void
    {
        $product->rating = $product->reviews()->avg('rating');
        $product->save();
    }
}
