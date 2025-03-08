<?php

namespace App\Http\Requests;

class ReviewRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required', 'string'],
        ];
    }
}
