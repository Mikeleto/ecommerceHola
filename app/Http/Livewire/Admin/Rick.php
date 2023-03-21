<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
class Rick extends Component
{
    use WithPagination;
    public $search;
    public $perPage = 10;
    public $name = true;
    public $category = true;
    public $price = true;
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $nameFilter;
    public $categoryFilter;
    public $brandFilter;

    public function sortBy($field){
        if($this->sortField === $field){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }else{
            if($field === 'subcategory.category.name'){
                $this->sortDirection = 'subcategory_id';
            }elseif ($field === 'brand'){
                $this->sortDirection = 'brand_id';

            }else{
                $this->sortField = $field;
            }
        }
}
    public function render()
    {
        $query = Product::query();

        $products = $query
            ->orderBy($this->sortField , $this->sortDirection)
            ->applyFilters([
              'nameFilter' => $this->nameFilter,
              'categoryFilter' => $this->categoryFilter,
              'brandFilter' => $this->brandFilter,
            ])
        ->paginate($this->perPage);
        return view('livewire.admin.rick', [
            'products' => $products,
            'name' => $this->name,
            'category' => $this->category,
            'price' => $this->price,

        ])->layout('layouts.admin');
    }

    public function resetFilters(){
        $this->nameFilter = null;
        $this->categoryFilter = null;
        $this->brandFilter = null;

    }
}
