<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()->where('status', '!=', 1);

        if (request('status')) {
            $orders->where('status', request('status'));
        }

        $orders = $orders->get();

        for ($i = 1; $i <= 5; $i++) {
            $ordersByStatus[$i] = Order::where('status', $i)->count();
        }

        return view('admin.orders.index', compact('orders', 'ordersByStatus'));
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function cancelOrder(Request $request, Order $order)
    {
        $order->cancel();
        return redirect()->route('admin.orders.show', $order);
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
