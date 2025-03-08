<?php

namespace App\Http\Requests;

class CategoryRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
        ];
    }
}
