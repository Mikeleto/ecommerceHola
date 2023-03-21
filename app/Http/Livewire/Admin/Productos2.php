<?php

namespace App\Http\Livewire\Admin;

use App\Models\Color;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use App\Filters\ProductFilter;
use App\Queries\ProductBuilder;

class Productos2 extends Component
{
    use WithPagination;

    public $search;
    public $perPage = 10;
    public $columns = [
        'name' == true,
        'status' => 'Estado',
        'price' => 'Precio',
        'subcategory' => 'Subcategoria',
        'brand' => 'Marca',
        'sold' => 'vendidos',
        'stock' => 'Stock',
        'created_at' => 'Fecha de creacion'
    ];


    public $selectedColumns = ['name' == true, 'subcategory', 'price', 'brand'];
    public $selectedColumns2 = [];
    public $sortField = 'name';
    public $sortDirection = 'asc';


    public $nameFilter;
    public $categoryFilter;
    public $brandFilter;
    public $minPriceFilter;
    public $maxPriceFilter;
    public $startDateFilter;
    public $endDateFilter;

    public $name = true;

    public $subcategory = true;

    public $wtf = true;



    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            if($field === 'subcategory.category.name'){
                $this->sortField = 'subcategory_id';
            } elseif ($field === 'brand_id.name') {
                $this->sortField = 'brand_id';
            }else{
                $this->sortField = $field;
            }


        }
    }
    public function render()
    {


        // Get products
        $query = Product::query();


        if($this->minPriceFilter){
            $query->where('price','>=', $this->minPriceFilter);
        }
        if($this->maxPriceFilter){
            $query->where('price','<=', $this->maxPriceFilter);
        }
        if($this->startDateFilter){
            $query->whereDate('created_at','<=', $this->startDateFilter);
        }
        if($this->endDateFilter){
            $query->whereDate('created_at','<=', $this->endDateFilter);
        }
            $products = $query

            ->applyFilters([
                'search' => $this->search,
               'categoryFilter' => $this->categoryFilter,
                'brandFilter'=> $this->brandFilter,
            ])
                ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.productos2', compact('products'),[





        ])->layout('layouts.admin');
    }



    // Filter methods
    public function resetFilters()
    {
        $this->nameFilter = null;
        $this->categoryFilter = null;
        $this->brandFilter = null;
        $this->minPriceFilter = null;
        $this->maxPriceFilter = null;
        $this->startDateFilter = null;
        $this->endDateFilter = null;
    }

}
