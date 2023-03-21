<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class productos2Test extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testProductos2ComponentRendersWithProducts()
    {
        $product = Product::factory()->create();

        Livewire::test(Productos2::class)
            ->assertSee($product->name)
            ->assertSee($product->price);
    }
    public function testProductos2ComponentPaginatesProducts()
    {
        Product::factory()->count(20)->create();

        Livewire::test(Productos2::class)
            ->assertSee('1-10 of 20')
            ->call('gotoPage', 2)
            ->assertSee('11-20 of 20');
    }


}
