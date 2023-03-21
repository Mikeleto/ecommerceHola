<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\Color;
use App\Models\ColorSize;
use App\Models\ColorProduct;
use App\Models\Department;
use App\Models\Product;
use App\Models\Size;
use Livewire\Component;
use Livewire\WithPagination;
class Zelda extends Component
{
    use Withpagination;
    public $search;
    public $perPage = 10;
    public $name = true;
    public $categoryw = true;
    public $price = true;
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $categoryFilter ;
    public $brandFilter ;
    public $maxPriceFilter ;
    public $minPriceFilter ;
    public $colorFilter;
    public $colorFilter2;
    public $sizeFilter;

    public function sortBy($field){
        if($this->sortField === $field){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }else{
            if($field === 'subcategory.category.name'){
                $this->sortField = 'subcategory_id';
            } elseif($field === 'brand'){
                $this->sortField = 'brand_id';
            }else{
                $this->sortField = $field;
            }
        }
    }
    public function search()
    {
        $results = YourModel::query();
        $this->colorSizeFilter($results, $this->colorFilter, $this->colorFilter2);
        $results = $results->get();
        // ...
    }
    public function render()
    {
        $colorProduct = ColorProduct::all();


        $query = Product::query();

$products = $query->orderBy($this->sortField ,$this->sortDirection)
    ->applyFilters([

        'categoryFilter' => $this->categoryFilter,
        'brandFilter' => $this->brandFilter,
        'minPriceFilter' => $this->minPriceFilter,
        'maxPriceFilter' => $this->maxPriceFilter,
        'colorFilter' => $this->colorFilter,
        'colorFilter2' => $this->colorFilter2,
        'sizeFilter' => $this->sizeFilter,
    ])
->paginate($this->perPage);

        return view('livewire.admin.zelda', [
            'products' => $products,
'colorProduct' => $colorProduct,
            'name' => $this->name,
            'category' => $this->categoryw,
            'price' => $this->price,


        ])->layout('layouts.admin');
    }
}
