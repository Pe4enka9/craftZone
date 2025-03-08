<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MetaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'meta' => [
                'current_page' => $this->resource->currentPage(),
                'per_page' => $this->resource->perPage(),
                'total' => $this->resource->total(),
            ],
        ];
    }
}
