<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
class Patata2 extends Component
{
    use WithPagination;

    public $search;
    public $perPage =10;
    public $name = true;
    public $subcategory = true;
    public $price = true;
    public $status = true;
    public $created_at =true;
    public $brand = true;
    public $stock = true;
    public $sold = true;
    public $sortField = 'name';
    public $sortDirection = 'asc';

    public $nameFilter;
    public $categoryFilter;
    public $brandFilter;
    public $maxPriceFilter;
    public $minPriceFilter;
    public $endCreateFilter;
    public $startCreateFilter;

    public function sortBy($field){
if($this->sortField === $field){
$this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
}else{
    if($field === 'sucategory.category.name'){
        $this->sortField = 'subcategory_id';

    }elseif ($field === 'brand_id.name'){
        $this->sortField = 'brand_id';
    }elseif ($field === 'unconfirmed'){
        $this->sortField = 'unconfirmed';
    }else{
        $this->sortField = $field;
    }
}
}
    public function render()
    {

        $query = Product::query()
        ->when($this->categoryFilter, function ($query){
        return $query->whereHas('subcategory.category', function ($query){
            $query->where('id', $this->categoryFilter);
        });
    })
        ->when($this->brandFilter, function ($query){
        return $query->whereHas('brand_id', function ($query){
            $query->where('brand_id', $this->brandFilter);
        });
    });




        if($this->nameFilter){
            $query->where('name','LIKE',"%{$this->nameFilter}%");
        }
        if ($this->maxPriceFilter) {
            $query->where('price', '<=', $this->maxPriceFilter);
        }
        if ($this->minPriceFilter) {
            $query->where('price', '>=', $this->minPriceFilter);
        }
        if ($this->startCreateFilter) {
            $query->whereDate('created_at', '<=', $this->startCreateFilter);
        }
        if ($this->endCreateFilter) {
            $query->where('created_at', '>=', $this->endCreateFilter);
        }
        $products = $query->orderBy($this->sortField, $this->sortDirection)




        ->paginate($this->perPage);
        return view('livewire.admin.patata2', [
'products' => $products
        ])->layout('layouts.admin');
    }
    public function resetFilter(){
$this->nameFilter = null;
        $this->categoryFilter = null;
        $this->brandFilter = null;
        $this->minPriceFilter = null;
        $this->maxPriceFilter = null;
        $this->startCreateFilter = null;
        $this->endCreateFilter = null;


    }
}
