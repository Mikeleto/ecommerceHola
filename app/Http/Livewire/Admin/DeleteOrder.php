<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class DeleteOrder extends Component
{
    public function deleteProduct($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();
        session()->flash('success', 'Producto eliminado exitosamente.');
    }

    public function render()
    {

        return view('livewire.admin', [
            'product' => $this->product,
        ])

            ->layout('layouts.admin');
    }

}
