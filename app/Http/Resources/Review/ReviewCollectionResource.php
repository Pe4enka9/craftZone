<?php

namespace App\Http\Resources\Review;

use App\Http\Resources\MetaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReviewCollectionResource extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => ReviewResource::collection($this->collection),
            'meta' => new MetaResource($this),
        ];
    }
}
