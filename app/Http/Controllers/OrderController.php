<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\Order\OrderCollectionResource;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    // Создание заказа
    public function store(OrderRequest $request): JsonResponse
    {
        $totalAmount = 0;
        $items = [];

        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            $totalAmount += $product->price * $item['quantity'];
            $items[] = new OrderItem([
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price_at_purchase' => $product->price,
            ]);
        }

        $order = Order::create([
            'user_id' => $request->user()->id,
            'total_amount' => $totalAmount,
            'order_status_id' => 1,
        ]);

        $order->items()->saveMany($items);

        return response()->json(new OrderResource($order), 201);
    }

    // Получение списка заказов
    public function index(): JsonResponse
    {
        return response()->json(new OrderCollectionResource(Order::paginate(10)));
    }

    // Получение одного заказа
    public function show(Order $order): JsonResponse
    {
        return response()->json(new OrderResource($order));
    }

    // Изменение статуса заказа
    public function updateStatus(Request $request, Order $order): JsonResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'integer', Rule::exists(OrderStatus::class, 'id')],
        ]);

        $order->update([
            'order_status_id' => $validated['status'],
        ]);

        return response()->json(new OrderResource($order));
    }
}
