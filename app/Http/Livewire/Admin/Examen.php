<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ColorProduct;
class Examen extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $search;
    public $name = true;
    public $category = true;
    public $status = true;
    public $price = true;
    public $brand = true;
    public $stock = true;
    public $created_at = true;
    public $sold = true;
    public $wait = true;
    public $color = true;
    public $sizes = true;
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $nameFilter;
    public $categoryFilter;
    public $brandFilter;
    public $maxPriceFilter;
    public $minPriceFilter;
    public $startDateFilter;
    public $endDateFilter;
    public $colorFilter;
    public $colorFilter2;
    public $sizeFilter;

    public function sortBy($field){
        if($this->sortField === $field){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }else{
            if($field === 'subcategory.category'){
                $this->sortField = 'subcategory_id' ;
            } elseif($field === 'brand'){
                $this->sortField = 'brand_id' ;
            } elseif($field === 'sold'){
                $this->sortField = 'sold' ;
            } elseif($field === 'wait'){
                $this->sortField = 'wait' ;

            }else{
                $this->sortField = $field;
            }
        }
    }
    public function render()
    {
        $colorProduct = ColorProduct::all();
        $query = Product::query();


        $products = $query
            ->applyFilters([
                'nameFilter' => $this->nameFilter,
                'categoryFilter' => $this->categoryFilter,
                'brandFilter' => $this->brandFilter,
                'maxPriceFilter' => $this->maxPriceFilter,
                'minPriceFilter' => $this->minPriceFilter,
                'startDateFilter' => $this->startDateFilter,
                'endDateFilter' => $this->endDateFilter,
                'colorFilter' => $this->colorFilter,
                'colorFilter2' => $this->colorFilter2,
                'sizeFilter' => $this->sizeFilter,

            ])
            ->orderBy($this->sortField, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.admin.examen',[
            'products' => $products,
            'colorProduct' => $colorProduct,
            'name' => $this->name,
            'category' => $this->category,
            'status' => $this->status,
            'price' => $this->price,
            'brand' => $this->brand,
            'stock' => $this->stock,
            'created_at' => $this->created_at,
            'sold' => $this->sold,
            'wait' => $this->wait,

        ])->layout('layouts.admin');
    }
    public function resetFilters(){
        $this->nameFilter = null;
        $this->categoryFilter = null;
        $this->brandFilter = null;
        $this->maxPriceFilter = null;
        $this->minPriceFilter = null;
        $this->startDateFilter = null;
        $this->endDateFilter = null;
        $this->colorFilter = null;
        $this->colorFilter2 = null;
        $this->sizeFilter = null;
    }
}
