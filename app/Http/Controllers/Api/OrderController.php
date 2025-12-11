<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\StockHistory;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index(): JsonResponse
    {
        $orders = Order::with('details')
            ->latest()
            ->get()
            ->map(fn ($order) => $this->appendItemsOrdered($order));

        return $this->success($orders);
    }

    public function status(string $status): JsonResponse
    {
        $orders = Order::where('status', $status)
            ->with('details')
            ->latest()
            ->get()
            ->map(fn ($order) => $this->appendItemsOrdered($order));

        return $this->success($orders);
    }

    public function user(User $user): JsonResponse
    {
        $orders = $user->orders()
            ->with('details')
            ->latest()
            ->get()
            ->map(fn ($order) => $this->appendItemsOrdered($order));

        return $this->success($orders);
    }

    public function show(Order $order): JsonResponse
    {
        $order->load('details');

        return $this->success($this->appendItemsOrdered($order));
    }

    public function stats(): JsonResponse
    {
        $totalOrders = Order::count();
        $todayRevenue = Order::whereDate('pickup_date', today())->sum('total_amount');

        return $this->success([
            'total_orders' => $totalOrders,
            'today_revenue' => $todayRevenue,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'customer_name' => ['required', 'string', 'max:100'],
            'customer_phone' => ['nullable', 'string', 'max:20'],
            'pickup_date' => ['required', 'date'],
            'pickup_time' => ['required'],
            'notes' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.menu_item_id' => ['required', 'exists:menu_items,id'],
            'items.*.menu_name' => ['required', 'string'],
            'items.*.price' => ['required', 'numeric', 'min:0'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
        ]);

        return DB::transaction(function () use ($data) {
            $orderCode = $this->generateOrderCode();
            $totalAmount = collect($data['items'])->sum(fn ($item) => $item['price'] * $item['quantity']);

            $order = Order::create([
                'order_code' => $orderCode,
                'user_id' => $data['user_id'],
                'customer_name' => $data['customer_name'],
                'customer_phone' => $data['customer_phone'] ?? null,
                'pickup_date' => $data['pickup_date'],
                'pickup_time' => $data['pickup_time'],
                'notes' => $data['notes'] ?? null,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'payment_method' => 'pending',
                'payment_status' => 'unpaid',
            ]);

            foreach ($data['items'] as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $item['menu_item_id'],
                    'menu_name' => $item['menu_name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);

                $menuItem = MenuItem::find($item['menu_item_id']);
                $menuItem->decrement('stock', $item['quantity']);

                StockHistory::create([
                    'menu_item_id' => $menuItem->id,
                    'quantity_change' => -$item['quantity'],
                    'type' => 'out',
                    'notes' => 'Order: '.$orderCode,
                    'created_by' => $data['user_id'],
                ]);
            }

            $order->load('details');

            return $this->success($this->appendItemsOrdered($order), 'Pesanan berhasil dibuat', 201);
        });
    }

    public function updateStatus(Request $request, Order $order): JsonResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['pending', 'processing', 'ready', 'completed', 'cancelled'])],
        ]);

        $order->update(['status' => $validated['status']]);

        if ($validated['status'] === 'cancelled') {
            $this->restoreStock($order);
        }

        return $this->success($order->fresh());
    }

    public function updatePayment(Request $request, Order $order): JsonResponse
    {
        $validated = $request->validate([
            'payment_method' => ['required', Rule::in(['cash', 'qris', 'dana', 'gopay'])],
        ]);

        $order->update([
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'paid',
            'status' => 'completed',
        ]);

        return $this->success($order->fresh(), 'Pembayaran berhasil');
    }

    public function destroy(Order $order): JsonResponse
    {
        $this->restoreStock($order);

        $order->update(['status' => 'cancelled']);

        return $this->success(null, 'Pesanan dibatalkan');
    }

    private function appendItemsOrdered(Order $order): Order
    {
        $order->items_ordered = $order->details
            ->map(fn ($detail) => "{$detail->menu_name} ({$detail->quantity})")
            ->implode(', ');

        return $order;
    }

    private function generateOrderCode(): string
    {
        $random = str_pad((string) random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        return 'ORD'.now()->format('Ymd').$random;
    }

    private function restoreStock(Order $order): void
    {
        $order->loadMissing('details');

        foreach ($order->details as $detail) {
            $menuItem = MenuItem::find($detail->menu_item_id);
            if ($menuItem) {
                $menuItem->increment('stock', $detail->quantity);

                StockHistory::create([
                    'menu_item_id' => $menuItem->id,
                    'quantity_change' => $detail->quantity,
                    'type' => 'in',
                    'notes' => 'Cancel Order: '.$order->order_code,
                    'created_by' => $order->user_id,
                ]);
            }
        }
    }

    private function success($data, string $message = 'OK', int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}

