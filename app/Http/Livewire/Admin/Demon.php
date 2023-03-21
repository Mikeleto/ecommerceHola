<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
class Demon extends Component
{
    use WithPagination;
    public $search;
    public $perPage = 10;
    public $name = true;
    public $status = true;
    public $price = true;
    public $sortField = 'name';
    public $sortDirection ='asc';
    public $nameFilter;
    public $brandFilter;
    public $maxPriceFilter;
    public $minPriceFilter;

    public function sortBy($field){
        if($this->sortField === $field){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }else{
if($field === 'subcategory.category.name'){
    $this->sortField = 'subcategory_id';
}elseif ($field === 'brand' ){
    $this->sortField = 'brand_id';
}else{
    $this->sortField = $field;
}
        }
    }
    public function render()
    {
        $query = Product::query();

            $products = $query
                ->applyFilters([
                    'nameFilter' => $this->nameFilter,
                    'brandFilter' => $this->brandFilter,
                    'maxPriceFilter' => $this->maxPriceFilter,
                    'minPriceFilter' => $this->minPriceFilter,
                ])
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
        return view('livewire.admin.demon', [
            'products' => $products,
            'status' => $this->status,
            'price' => $this->price,

        ])->layout('layouts.admin');
    }

    public function resetFilters(){
        $this->nameFilter = null;
        $this->brandFilter = null;
        $this->maxPriceFilter = null;
        $this->minPriceFilter = null;


    }
}
