<?php

namespace App\Http\Livewire\Admin;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Dormir extends Component
{

use WithPagination;
public $search;
public $perPage = 10;
public $name = true;
public $category = true;
public $status = true;
public $price = true;
public $brand = true;
public $stock = true;
public $created_at = true;
public $sold = true;
public $sortField = 'name';
public $sortDirection = 'asc';

public $categoryFilter ;
public $minPriceFilter;
public $maxPriceFilter;
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            if($field === 'subcategory.category.name'){
                $this->sortField = 'subcategory_category';
            } elseif ($field === 'brand_id.name') {
                $this->sortField = 'brand_id';
            }else{
                $this->sortField = $field;
            }


        }
    }


    public function render()
    {
        $query = Product::query();
             if ($this->categoryFilter) {
                 $query->whereHas('subcategory.category', function ($query){
                     $query->where('name', 'LIKE', "%{$this->categoryFilter}%");
                 });
                }

        if($this->maxPriceFilter){
            $query->where('price', '<=', $this->maxPriceFilter);
        }
           $products = $query ->orderBy($this->sortField, $this->sortDirection)
->applyFilters([
    'category'=>$this->categoryFilter,
     'price'=>$this->minPriceFilter,
         'price'=>$this->maxPriceFilter
])
            ->paginate($this->perPage);
        return view('livewire.admin.dormir', [
          'products' => $products,
            'name' => $this->name,
            'category' => $this->category,
            'status'=> $this->status,
            'price' => $this->price,
            'brand' => $this->brand,
            'stock' => $this->stock,
            'price' =>$this->minPriceFilter,
            'price' => $this->maxPriceFilter,
            'sold' => $this->sold

        ])->layout('layouts.admin');

    }
    public function resetFilters(){
    $this->categoryFilter = null;
    $this->maxPriceFilter = null;
    $this->minPriceFilter = null;
    }
}
