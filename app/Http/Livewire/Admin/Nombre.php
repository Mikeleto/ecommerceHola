<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
class Nombre extends Component
{
    use WithPagination;
    public $search;
    public $perPage = 10;
    public $name = true;
    public $category = true;
    public $created_at = true;
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $nameFilter ;
    public $categoryFilter;
    public $brandFilter;

    public function sortBy($field){
        if($this->sortField === $field){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }else{
            if($field === 'subcategory.category'){
$this->sortField = 'subcategory_id';
            }elseif($field === 'brand_id'){
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
                    'categoryFilter' => $this->categoryFilter,
                    'brandFilter' => $this->brandFilter
                ])
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
        return view('livewire.admin.nombre', [
'products' => $products,
            'name' => $this->name,
            'category' => $this->category,
            'created_at' => $this->created_at
        ])->layout('layouts.admin');
    }

    public function resetFilters(){
        $this->nameFilter = null;
        $this->categoryFilter = null;
        $this->brandFilter = null;
    }
}
