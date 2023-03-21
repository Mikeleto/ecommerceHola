<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class PaymentOrder extends Component
{
    use AuthorizesRequests;

    public $order;

    protected $listeners = ['payOrder'];

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function payOrder()
    {
        $this->order->status = 2;
        $this->order->save();

        return redirect()->route('orders.show', $this->order);
    }
    public function deleteOrder()
    {
        $this->authorize('delete', $this->order);

        // Verificar si el producto existe


        // Restaurar la cantidad de inventario anterior
        $previousInventory = $this->order->quantity;

        // Actualizar la cantidad de inventario del producto


        // Eliminar el pedido
        $this->order->delete();
        $this->restoreStock();

        session()->flash('message', 'Pedido eliminado exitosamente.');

        return redirect()->route('orders.index');
    }


    public function restoreStock(){
        $items = json_decode($this->order->content);
        foreach ($items as $item){
            $product = Product::find($item->id);
            $product->quantity +- $item->qty;
            $product->sold -= $item->qty;
            $product->save();
        }
    }


    public function render()
    {
        $this->authorize('view', $this->order);

        $items = json_decode($this->order->content);
        $envio = json_decode($this->order->envio);

        return view('livewire.payment-order', compact('items', 'envio'));;
    }
}
