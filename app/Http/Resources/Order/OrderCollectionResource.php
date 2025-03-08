<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\MetaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollectionResource extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => OrderResource::collection($this->collection),
            'meta' => new MetaResource($this),
        ];
    }
}
