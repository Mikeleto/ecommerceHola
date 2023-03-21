<?php

namespace Browser;

use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\Image;
use App\Models\Order;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Spatie\Permission\Models\Role;
use Tests\DuskTestCase;

class KinTest extends DuskTestCase{

    use DatabaseMigrations;

    /*
    * A basic browser test example.
    *
    * @return void
    */
    public function test_kinTest ()
    {


        $brand = Brand::factory()->create();
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'subcategoria',
            'slug' => 'subcategoria',
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,


        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        $p2 = Product::factory()->create([
            'subcategory_id' => $subcategory->id
        ]);
        Image::factory()->create([
            'imageable_id' => $p2->id,
            'imageable_type' => Product::class
        ]);
        $p3 = Product::factory()->create([
            'subcategory_id' => $subcategory->id
        ]);
        Image::factory()->create([
            'imageable_id' => $p3->id,
            'imageable_type' => Product::class
        ]);
        $p4 = Product::factory()->create([
            'subcategory_id' => $subcategory->id
        ]);
        Image::factory()->create([
            'imageable_id' => $p4->id,
            'imageable_type' => Product::class
        ]);
        $p5 = Product::factory()->create([
            'subcategory_id' => $subcategory->id
        ]);
        Image::factory()->create([
            'imageable_id' => $p5->id,
            'imageable_type' => Product::class
        ]);
        $p6 = Product::factory()->create([
            'subcategory_id' => $subcategory->id
        ]);
        Image::factory()->create([
            'imageable_id' => $p6->id,
            'imageable_type' => Product::class
        ]);
        $p7 = Product::factory()->create([
            'subcategory_id' => $subcategory->id
        ]);
        Image::factory()->create([
            'imageable_id' => $p7->id,
            'imageable_type' => Product::class
        ]);
        $p8 = Product::factory()->create([
            'subcategory_id' => $subcategory->id
        ]);
        Image::factory()->create([
            'imageable_id' => $p8->id,
            'imageable_type' => Product::class
        ]);
        $p9 = Product::factory()->create([
            'subcategory_id' => $subcategory->id
        ]);
        Image::factory()->create([
            'imageable_id' => $p9->id,
            'imageable_type' => Product::class
        ]);
        $p10 = Product::factory()->create([
            'subcategory_id' => $subcategory->id
        ]);
        Image::factory()->create([
            'imageable_id' => $p10->id,
            'imageable_type' => Product::class
        ]);
        $p11 = Product::factory()->create([
            'subcategory_id' => $subcategory->id
        ]);
        Image::factory()->create([
            'imageable_id' => $p11->id,
            'imageable_type' => Product::class
        ]);
        $p12 = Product::factory()->create([
            'subcategory_id' => $subcategory->id
        ]);
        Image::factory()->create([
            'imageable_id' => $p12->id,
            'imageable_type' => Product::class
        ]);
        $p13 = Product::factory()->create([
            'subcategory_id' => $subcategory->id
        ]);
        Image::factory()->create([
            'imageable_id' => $p13->id,
            'imageable_type' => Product::class
        ]);
        $p14 = Product::factory()->create([
            'subcategory_id' => $subcategory->id
        ]);
        Image::factory()->create([
            'imageable_id' => $p14->id,
            'imageable_type' => Product::class
        ]);
        $p15 = Product::factory()->create([
            'subcategory_id' => $subcategory->id
        ]);
        Image::factory()->create([
            'imageable_id' => $p15->id,
            'imageable_type' => Product::class
        ]);
        $p16 = Product::factory()->create([
            'subcategory_id' => $subcategory->id
        ]);
        Image::factory()->create([
            'imageable_id' => $p16->id,
            'imageable_type' => Product::class
        ]);

        $role = Role::create(['name' => 'admin']);
        $usuario = User::factory()->create([
            'name' => 'Antoniardo',
            'email' => 'prueba@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('admin');
        User::factory()->create([
            'id' => 2,
            'name' => 'Carlos Abrisqueta',
            'email' => 'carlos@test.com',
        ]);
        User::factory()->create([
            'id' => 3,
            'name' => 'Pikachu Master',
            'email' => 'picoypala@test.com',
        ]);

        $this->browse(function (Browser $browser) use ($usuario, $p1,  $p2, $p3, $p4, $p5) {
            $browser->loginAs($usuario)
                ->visitRoute('products.show', $p1)
                ->assertSee('Marca')
            ->pause(400)
                ->press('@añadir')
           ->screenshot('Kin')
                ->pause(400)
                ->visitRoute('products.show', $p2)
                ->assertSee('Marca')
                ->pause(400)
                ->screenshot('Kin2')
                ->press('@añadir')
                ->pause(400)
                ->press('@añadir')
                ->pause(500)
                ->screenshot('Kin3')
                ->click('@patata')
                ->pause(500)
                ->screenshot('Kin4')
                ->pause(500)
                ->click('@cart')
                ->pause(500)
                ->screenshot('Kin5')
                ->click('@bomb')
                ->pause(500)
                ->screenshot('Kin6')
                ->click('@omb')
                ->pause(500)
                ->screenshot('Kin7')



            ;

        });




    }
}
