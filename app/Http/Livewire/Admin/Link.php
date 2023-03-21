<?php

namespace App\Http\Livewire\Admin;

use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Livewire\Component;
use Livewire\WithPagination;

class Link extends Component
{
    public $search;
    public $perPage = 10;
    public $name = true;
    public $status = true;
   public  $price = true;
   public $sold = true;
   public $wait = true;
   public $sortField = 'name';
   public $sortDirection = 'asc';
   public $nameFilter;
   public $categoryFilter;
public $brandFilter;
    public $product;
    public $sizes;
    public $size_id = '';
    public $colors = [];
    public $color_id = '';
    public $qty = 1;
    public $quantity = 0;
    public $options = [];
    public $color;


   public function sortBy($field){
       if($this->sortField === $field){
           $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
       }else{
           if($field === 'subcategory.category.name'){
        $this->sortField = 'subcategory_id';
           }elseif ($field === 'brand_id'){
        $this->sortField = 'brand_id';
           }elseif ($field === 'wait_id'){
               $this->sortField = 'wait_id';
           }else{
               $this->sortField = $field;
           }
       }
   }



    public function render()
    {


        $query = Product::query();
        $color = Color::all();

           $products = $query ->orderBy($this->sortField , $this->sortDirection)
->applyFilters([
    'nameFilter' => $this->nameFilter,
    'categoryFilter' => $this->categoryFilter,
    'brandFilter' => $this->brandFilter
])
        ->paginate($this->perPage)
       ;

        return view('livewire.admin.link', compact('products'),[
            'products' => $products,
            'color' => $color,
            'name' => $this->name,
            'status' => $this->status,
            'price' => $this->price,
            'name' => $this->nameFilter,
                   'category' => $this->categoryFilter,
                   'brand' => $this->brandFilter,
        ])->layout('layouts.admin');
    }
    public function resetFilters(){
       $this->nameFilter = null;
       $this->categoryFilter = null;
       $this->brandFilter = null;
    }
}
