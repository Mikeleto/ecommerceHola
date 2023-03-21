<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;


class Patata extends Component
{
    use withPagination;

    public $perPage = 10;
public $search ;
public $name = true;
    public $category = true;
    public $status = true;
    public $price = true;
    public $brand = true;
    public $stock = true;
    public $create = true;

public $nameFilter;
public $categoryFilter;
public $brandFilter;
public $minPriceFilter;

public $maxPriceFilter;
public $startDateFilter;
public $endDateFilter;
public $sortField = 'name';
public $sortDirection = 'asc';

public function sortBy($field){
    if($this->sortField === $field){
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }else{
        if($field === 'subcategory.category.id'){
            $this->sortField = 'subcategory_id';

        }elseif ($field === 'brand_id.name'){
            $this->sortField = 'brand_id';
        }else{
            $this->sortField = $field;
        }
    }
}


    public function render()
    {
        $query = Product::query();

        if($this->startDateFilter){
            $query->whereDate('created_at', $this->startDateFilter);
        }
        if($this->endDateFilter){
            $query->where('created_at', $this->endDateFilter);
        }

    $products  = $query
->orderBy($this->sortField,$this->sortDirection)
        ->applyFilters([
            'name' =>$this->name,
            'category' =>$this->category,
            'status' =>$this->status,
            'price' =>$this->price,
            'brand' =>$this->brand,
            'stock' =>$this->stock,
            'create_at' =>$this->create,
            'nameFilter' =>$this->nameFilter,
            'categoryFilter' => $this->categoryFilter,
            'brandFilter' => $this->brandFilter,
            'minPriceFilter' => $this->minPriceFilter,
            'maxPriceFilter' => $this->maxPriceFilter,


        ])
        ->paginate($this->perPage);


        return view('livewire.admin.patata', [


            'products' => $products,

        ])->layout('layouts.admin');
    }

    public function resetFilter(){
    $this->nameFilter = null;
        $this->categoryFilter = null;
        $this->brandFilter = null;
        $this->maxPriceFilter = null;
        $this->minPriceFilter = null;
        $this->startDateFilter = null;
        $this->endDateFilter = null;
    }
}
