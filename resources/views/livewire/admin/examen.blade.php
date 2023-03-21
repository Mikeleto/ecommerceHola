<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                Lista de productos
            </h2>

            <x-button-link class="ml-auto" href="{{route('admin.products.create')}}">
                Agregar producto
            </x-button-link>
        </div>
    </x-slot>



    <x-table-responsive>


        <div class="px-6 py-4">
            <x-jet-input class="w-full"
                         wire:model="search"
                         type="text"
                         placeholder="🔍" />
        </div>
        <div class="px-6 py-4">
            <x-jet-input class="w-100"
                         wire:model="nameFilter"
                         type="text"
                         placeholder="Filtrar por nombre" />
            <x-jet-input class="w-100"
                         wire:model="categoryFilter"
                         type="text"
                         placeholder="Filtrar por categoria" />
            <x-jet-input class="w-100"
                         wire:model="brandFilter"
                         type="text"
                         placeholder="Filtrar por marca" />
            <x-jet-input type="number" class="w-100" placeholder="Precio minimo" wire:model.lazy="minPriceFilter" />
            <x-jet-input type="number" class=" w-100" placeholder="Precio máximo" wire:model.lazy="maxPriceFilter"/>
            <x-jet-input type="date" class=" w-100" placeholder="Fecha minima" wire:model.lazy="startDateFilter"/>
            <x-jet-input type="date" class=" w-100" placeholder="Fecha máxima" wire:model.lazy="endDateFilter"/>
            <x-jet-input type="text" placeholder="Filtrar por colores con tallas" wire:model="colorFilter" />
            <x-jet-input type="text" placeholder="Filtrar por colores sin tallas" wire:model="colorFilter2" />
            <x-jet-input type="text" placeholder="Filtrar por tallas" wire:model="sizeFilter"/>
            <x-button-link class="ml-auto" wire:click="resetFilters">
                Resetear filtros
            </x-button-link>
        </div>
        @if($products->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="#" wire:click="sortBy('name')">Ordenar el nombre</a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="#" wire:click="sortBy('price')">Ordenar el precio</a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="#" wire:click="sortBy('subcategory_id')">Ordenar las categorias</a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="#" wire:click="sortBy('brand_id')">Ordenar las marcas</a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="#" wire:click="sortBy('sold')">Ordenar los productos vendidos</a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="#" wire:click="sortBy('wait')">Ordenar los productos en espera</a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                    </th>
                <tr>
                    @if($name)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nombre
                    </th>
                    @endif
                    @if($category)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Categoría
                    </th>
                        @endif
                        @if($status)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Estado
                    </th>
                        @endif
                        @if($price)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Precio
                    </th>
                        @endif
                        @if($brand)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Marca
                    </th>
                        @endif
                        @if($stock)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Stock
                    </th>
                        @endif
                        @if($created_at)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Fecha
                    </th>
                        @endif
                        @if($sold)
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Vendidos
                            </th>
                        @endif
                        @if($wait)
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                En espera
                            </th>
                        @endif
                        @if($color)
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Color
                        </th>
                        @endif
                        @if($sizes)
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Talla
                        </th>
                        @endif

                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Editar</span>
                    </th>
                </tr>
                </tr>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $product)
                    <tr>
                        @if($name)
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 object-cover">
                                    <img class="h-10 w-10 rounded-full" src="{{ $product->images->count() ? Storage::url($product->images->first()->url) : 'img/default.jpg'  }}" alt="">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $product->name }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        @endif
                        @if($category)
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $product->subcategory->category->name }}</div>
                            <div class="text-sm text-gray-500">{{ $product->subcategory->name }}</div>
                        </td>
                            @endif
                            @if($status)
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $product->status == 1 ? 'red' : 'green'
                            }}-100 text-{{ $product->status == 1 ? 'red' : 'green' }}-800">
                                {{ $product->status == 1 ? 'Borrador' : 'Publicado' }}
                            </span>
                        </td>
                            @endif
                            @if($price)
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $product->price }} &euro;
                        </td>
                            @endif
                            @if($brand)
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $product->brand->name }}
                        </td>
                            @endif
                            @if($stock)
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $product->stock }}
                        </td>
                            @endif
                            @if($created_at)
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $product->created_at->format('d/m/Y') }}
                        </td>
                            @endif
                            @if($sold)
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $product->sold }}
                                </td>
                            @endif
                            @if($wait)
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $product->wait }}
                                </td>
                            @endif
                            @if($color)
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($product->sizes->isNotEmpty())

                                    @foreach ($colorProduct as $size)
                                        {{$size->color->name}}
                                    @endforeach

                                @elseif($product->color->isNotEmpty())
                                    @foreach ($colorProduct as $size)
                                        {{$size->color->name}}
                                    @endforeach

                                @else
                                    No hay colores disponibles
                                @endif
                            </td>
                            @endif
                            @if($sizes)
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($product->sizes->isNotEmpty())
                                    @foreach ($product->sizes as $size)
                                        {{$size->name}}
                                    @endforeach
                                @else
                                    No hay tallas disponibles
                                @endif
                            </td>
                            @endif

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="px-6 py-4">
                No existen productos coincidentes
            </div>
        @endif
        <div class="px-6 py-4">
            <label for="perPage">Productos por página:</label>
            <select class="form-control " wire:model="perPage" id="perPage">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>

        </div>
        <div class="flex inline-flex border-gray-600 border px-6 my-4">

            <x-jet-dropdown >
                <x-slot name="trigger">
                    <button>Columnas a mostrar</button>
                </x-slot>

                <x-slot name="content" >
                    <div>
                        Nombre<input type="checkbox" wire:model="name">
                    </div>
                    <div>
                        Categoria<input type="checkbox" wire:model="category">
                    </div>
                    <div>
                        Estado<input type="checkbox" wire:model="status">
                    </div>
                    <div>
                        Precio<input type="checkbox" wire:model="price">
                    </div>
                    <div>
                        Marca<input type="checkbox" wire:model="brand">
                    </div>
                    <div>
                        Stock<input type="checkbox" wire:model="stock">
                    </div>
                    <div>
                        Fecha<input type="checkbox" wire:model="created_at">
                    </div>
                    <div>
                        Vendidos<input type="checkbox" wire:model="sold">
                    </div>
                    <div>
                        En espera<input type="checkbox" wire:model="wait">
                    </div>
                    <div>
                        Colores<input type="checkbox" wire:model="color">
                    </div>
                    <div>
                        Talla<input type="checkbox" wire:model="sizes">
                    </div>
                </x-slot>
            </x-jet-dropdown>
        </div>
        @if($products->hasPages())
            <div class="px-6 py-4 border">
                {{ $products->links() }}
            </div>
        @endif
    </x-table-responsive>
</div>
