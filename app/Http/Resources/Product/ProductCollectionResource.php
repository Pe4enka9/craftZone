<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\MetaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollectionResource extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => ProductResource::collection($this->collection),
            'meta' => new MetaResource($this),
        ];
    }
}
