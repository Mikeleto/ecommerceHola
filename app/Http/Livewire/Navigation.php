<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class Navigation extends Component
{
    public $categoryFilter;
    public function render()
    {
        $query = Category::query();
        $categories = Category::all();
        if ($this->categoryFilter) {
            $query->whereHas('subcategory.category', function ($q) {
                $q->where('name', 'LIKE', "%{$this->categoryFilter}%");
            });
        }
        return view('livewire.navigation', compact('categories'), [
            'categoryFilter' => $this->categoryFilter
        ]);
    }
}
