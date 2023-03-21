<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
class Ganon extends Component
{
    use WithPagination;
    public $search;
    public $perPage = 10;
    public $name = true;
    public $category = true;
    public $brand = true;
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $nameFilter;
    public $categoryFilter;
    public $maxPriceFilter;
    public $minPriceFilter;

    public function sortBy($field){
        if($this->sortField === $field){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc': 'asc';
        }else if($field === 'subcategory.category.name'){
            $this->sortField = 'subcategory_id';

            }elseif ($field === 'brand.name'){
                $this->sortField = 'brand_id';
            }else{
                $this->sortField = $field;
            }

    }
    public function render()
    {
        $query = Product::query();


        $products = $query
->applyFilters([
    'nameFilter' => $this->nameFilter,
    'maxPriceFillter' => $this->maxPriceFilter,
    'minPriceFilter' => $this->minPriceFilter,
    'categoryFilter' => $this->categoryFilter,
])
->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
        return view('livewire.admin.ganon', [
            'products' => $products,
            'name' => $this->name,
            'category' => $this->category,
            'brand' => $this->brand,
        ])->layout('layouts.admin');
    }

    public function restFilters(){
        $this->nameFilter = null;
        $this->categoryFilter = null;
        $this->maxPriceFilter = null;
        $this->minPriceFilter = null;
    }
}
