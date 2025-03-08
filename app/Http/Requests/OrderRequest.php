<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Validation\Rule;

class OrderRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'items' => ['required', 'array'],
            'items.*.product_id' => ['required', 'integer', Rule::exists(Product::class, 'id')],
            'items.*.quantity' => ['required', 'integer'],
        ];
    }
}
