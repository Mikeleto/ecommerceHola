<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
class John extends Component
{
    use WithPagination;
    public $search;
    public $perPage = 10;
    public $name = true;
    public $fecha = true;
    public $stock = true;
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $categoryFilter ;
    public $brandFilter;
    public $maxPriceFilter;
    public $minPriceFilter;

    public function  sortBy($field){
        if($this->sortField === $field){
$this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }else{
            if($field === 'subcategory.category.name'){
                $this->sortField = 'subcategory_id';
            } elseif($field === 'brand_id'){
                $this->sortField = 'brand';
            }else{
                $this->sortField = $field;
            }
        }
    }
    public function render()
    {
        $query = Product::query();

        $products = $query    ->orderBy($this->sortField, $this->sortDirection)
            ->applyFilters([
                'maxPriceFilter' => $this->maxPriceFilter,
                'minPriceFilter' => $this->minPriceFilter,
                'categoryFilter' => $this->categoryFilter,
                'brandFilter' => $this->brandFilter,
            ])
            ->paginate($this->perPage);
        return view('livewire.admin.john', [
            'products' => $products,
            'name' => $this->name,
            'fecha' => $this->fecha,
            'stock' => $this->stock,
            'maxPriceFilter' => $this->maxPriceFilter,
            'minPriceFilter' => $this->minPriceFilter,
            'categoryFilter' => $this->categoryFilter,
            'brandFilter' => $this->brandFilter,
        ], compact('products'))->layout('layouts.admin');
    }
}
