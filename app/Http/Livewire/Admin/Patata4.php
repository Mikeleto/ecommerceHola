<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
class Patata4 extends Component
{
    public function render()
    {
        $products = Product::where('name', 'LIKE', "{}");
        return view('livewire.admin.patata4', [
            'products' => $products
        ])->layout('layouts.admin');
    }
}
