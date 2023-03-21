<?php

namespace App\Http\Livewire\Admin;


use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProducts extends Component
{
    use WithPagination;

    public $search;
    public $sortField = 'sold';
    public $sortDirection = 'asc';

    public function sortBy($field){
if($this->sortField === $field){
    $this->sortDirection = $this->sortDirection === 'asc' ? 'desc':'asc' ;
}else{
    if($field === 'subcategory.category.name'){
$this->sortField = 'subcategory_id';
    }elseif ($field === 'brand_id.name'){
        $this->sortField = 'brand_id';
    }else{
        $this->sortField = $field;
    }
}
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::query()
            ->applyFilters([
                'search' => $this->search,
            ])
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.show-products', compact('products'))

            ->layout('layouts.admin');
    }
}
