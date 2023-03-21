<?php

namespace App\Models;

use App\Filters\ProductFilter;
use App\Queries\ProductBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    use HasFactory;

    const BORRADOR = 1;
    const PUBLICADO = 2;

    protected $fillable = ['id','name', 'slug','color', 'description', 'price', 'subcategory_id', 'brand_id', 'quantity','sizes','sold','stock','wait'];
    //protected $guarded = ['id', 'created_at', 'updated_at'];
public function newEloquentBuilder($query)
{
    return new ProductBuilder($query);
}
public function newQueryFilter(){
    return new ProductFilter();
}


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function sizes(){
        return $this->hasMany(Size::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    public function colors(){
        return $this->belongsToMany(Color::class)->withPivot('quantity', 'id');
    }
    public function color(){
        return $this->belongsToMany(Color::class)->withPivot('quantity', 'id');
    }


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function getStockAttribute()
    {
        if ($this->subcategory->size) {
            return ColorSize::whereHas('size.product', function (Builder $query) {
                $query->where('id', $this->id);
            })->sum('quantity');
        } elseif ($this->subcategory->color) {
            return ColorProduct::whereHas('product', function (Builder $query) {
                $query->where('id', $this->id);
            })->sum('quantity');
        } else {
            return $this->quantity;
        }
    }

    //Funcion para obtener las ventas

    //Obtiene el ID del objeto actual usando $this->id.
    //Selecciona todos los pedidos (orders) que tengan un estado (status) de 2 usando el modelo Order. La columna content contiene un JSON que representa los productos que se ordenaron.
    //Itera sobre cada pedido y decodifica el JSON en un arreglo asociativo con json_decode(). Luego almacena el resultado en $orders[$i].
    //Combina todos los productos de todos los pedidos en una sola colección (collection) usando collapse().
    //Cuenta el número de productos vendidos para el producto actual. Para cada producto en la colección, si el ID del producto coincide con el ID del objeto actual, aumenta el contador $counter en la cantidad de ese producto.
    //Finalmente, devuelve el contador $counter, que representa el número total de unidades del producto actual vendidas.
    public function getSoldAttribute()
    {
        $id = $this->id;
        $orders = Order::select('content')->where('status', 2)->get();
        $i = 0;

        foreach($orders as $order) {
            $orders[$i] = json_decode($order->content, true);
            $i++;
        }
        $products = $orders->collapse();
        $counter = 0;
        foreach ($products as $product) {

            if ($product['id'] == $id) {
                $counter = $counter + $product['qty'];
            };
        }
        return $counter;
    }



    public function getWaitAttribute()
    {
        $id = $this->id;
        $orders = Order::select('content')->where('status', 1)->get();
        $i = 0;

        foreach($orders as $order) {
            $orders[$i] = json_decode($order->content, true);
            $i++;
        }
        $products = $orders->collapse();
        $counter = 0;
        foreach ($products as $product) {

            if ($product['id'] == $id) {
                $counter = $counter + $product['qty'];
            };
        }
        return $counter;
    }

}
