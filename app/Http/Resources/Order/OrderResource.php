<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\OrderItemResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Order
 */
class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'total_amount' => $this->total_amount,
            'status' => $this->status->name,
            'items' => OrderItemResource::collection($this->items),
        ];
    }
}
