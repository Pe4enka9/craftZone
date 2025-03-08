<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Validation\Rule;

class ProductRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'category_id' => ['required', 'integer', Rule::exists(Category::class, 'id')],
            'quantity' => ['required', 'integer'],
        ];
    }
}
