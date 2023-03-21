<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()->where('user_id', auth()->user()->id);

        if (request('status')) {
            $orders->where('status', request('status'));
        }

        $orders = $orders->get();

        for ($i = 1; $i <= 5; $i++) {
            $ordersByStatus[$i] = Order::where('user_id', auth()->user()->id)->where('status', $i)->count();
        }

        return view('orders.index', compact('orders', 'ordersByStatus'));
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);

        $items = json_decode($order->content);
        $envio = json_decode($order->envio);

        return view('orders.show', compact('order', 'items', 'envio'));
    }
    public function cancelOrder(Request $request, Order $order)
    {
        $order->cancel();
        return redirect()->route('orders.show', $order);
    }
// Controlador de órdenes
    public function cancel(Order $order)
    {
        // Verifica que el usuario tenga permiso para cancelar la orden
        if ($order->user_id != auth()->user()->id) {
            abort(403, "No tienes permiso para cancelar esta orden.");
        }

        // Actualiza el estado de la orden a "anulado"
        $order->status = Order::ANULADO;
        $order->save();

        // Redirecciona al usuario a una página de confirmación
        return view('orders.cancelled', ['order' => $order]);
    }

}
