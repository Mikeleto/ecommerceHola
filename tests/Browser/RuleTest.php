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
use Illuminate\Support\Facades\Log;
use Laravel\Dusk\Browser;
use Spatie\Permission\Models\Role;
use Tests\DuskTestCase;

class RuleTest extends DuskTestCase{

    use DatabaseMigrations;

    /*
    * A basic browser test example.
    *
    * @return void
    */
    public function test_ruleTest ()
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
           ->screenshot('Rule')
                ->pause(400)
                ->visitRoute('products.show', $p2)
                ->assertSee('Marca')
                ->pause(400)
                ->screenshot('Rule2')
                ->press('@añadir')
                ->pause(400)
                ->press('@añadir')
                ->pause(500)
                ->screenshot('Rule3')
                ->click('@patata')
                ->pause(500)
                ->screenshot('Rule4')
                ->pause(500)
                ->click('@cart')
                ->pause(500)
                ->screenshot('Rule5')
                ->press('@boton')
                ->pause(500)
                ->screenshot('Rule6')
                ->press('@kill')
                ->pause(500)
                ->screenshot('Rule7');
                Log::info('Se le enviara un correo con los pedidos pendientes');
            Log::info($p1->name .'con una cantidad de '. $p1->wait);
            Log::info($p2->name .'con una cantidad de '. $p2->wait);
                $browser->visit('/')
                ->press('@boton')
                ->pause(500)
                ->screenshot('Rule8')
                ->press('@abrir')
                ->pause(500)
                ->screenshot('Rule9')
                ->type('email', 'prueba@gmail.com')
                ->pause(400)
                ->screenshot('Rule10')
                ->type('password', '12345678')
                ->pause(400)
                ->screenshot('Rule11')
                ->press('INICIAR SESIÓN')
                ->pause(400)
                ->screenshot('Rule12')
                ->assertSee('3')

            ;

        });




    }
}
