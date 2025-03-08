<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollectionResource extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => OrderResource::collection($this->collection),
            'meta' => [
                'current_page' => $this->resource->currentPage(),
                'per_page' => $this->resource->perPage(),
                'total' => $this->resource->total(),
            ],
        ];
    }
}
