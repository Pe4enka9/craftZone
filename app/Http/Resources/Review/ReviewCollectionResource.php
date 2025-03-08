<?php

namespace App\Http\Resources\Review;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReviewCollectionResource extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => ReviewResource::collection($this->collection),
            'meta' => [
                'current_page' => $this->resource->currentPage(),
                'per_page' => $this->resource->perPage(),
                'total' => $this->resource->total(),
            ],
        ];
    }
}
