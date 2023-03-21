<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class Patata3 extends Component
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
    public $to = true;
    public $sortField = 'name';
    public $sortDirection = 'asc';
public $nameFilter;
public $categoryFilter;
public $brandFilter;
public $minPriceFilter;
public $maxPriceFilter;
public $endDateFilter;
public $startDateFilter;
    public function sortBy($field){
        if($this->sortField === $field){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }else{
            if($field === 'subcategory.category.name'){
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

            ->orderBy($this->sortField, $this->sortDirection)
            ->applyFilters([

               'categoryFilter' => $this->categoryFilter,
                'brandFilter'=> $this->brandFilter,
                'nameFilter'=> $this->nameFilter

            ])

                ->orderBy($this->sortField, $this->sortDirection)
        ->paginate(10);

        return view('livewire.admin.patata3', compact('products'),[

'stock' => $this->stock


        ])->layout('layouts.admin');
    }

    public function resetFilters(){
        $this->nameFilter = null;
        $this->categoryFilter = null;
        $this->brandFilter = null;
        $this->minPriceFilter = null;
        $this->maxPriceFilter = null;
        $this->startDateFilter = null;
        $this->endDateFilter = null;

    }
}
