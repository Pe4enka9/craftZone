<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\MetaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollectionResource extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => CategoryResource::collection($this->collection),
            'meta' => new MetaResource($this),
        ];
    }
}
