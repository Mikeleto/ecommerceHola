<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                Lista de productos 2
            </h2>
            <input type="checkbox" wire:model="price">
            <x-button-link class="ml-auto" href="{{route('admin.products.create')}}">
                Agregar producto
            </x-button-link>
        </div>
    </x-slot>


    <div class="flex inline-flex border-gray-200 border mx-6 p-6">
        <x-jet-dropdown>
            <x-slot name="trigger">
                <button>Columnas a mostrar</button>
            </x-slot>

            <x-slot name="content">
                Nombre<input type="checkbox" wire:model="name">
                Precio<input type="checkbox" wire:model="wtf">

            </x-slot>
        </x-jet-dropdown>

    </div>

    <div>
        <div class="mb-4">
            <input type="text" class="form-control" placeholder="Buscar por nombre" wire:model="search">
        </div>


        <div class="mb-4">
            <input type="text" class="form-control" placeholder="Buscar por Marca" wire:model.debounce.500ms="brandFilter">
        </div>
        <div class="mb-4">
            <input type="text" class="form-control" placeholder="Buscar por categoria" wire:model.debounce.500ms="categoryFilter">
        </div>

        <div class="mb-4">
            <div class="row">
                <div class="col-md-6">
                    <input type="number" class="form-control" placeholder="Precio mínimo" wire:model.lazy="minPriceFilter">
                </div>
                <div class="col-md-6">
                    <input type="number" class="form-control" placeholder="Precio máximo" wire:model.lazy="maxPriceFilter">
                </div>
            </div>
        </div>

        <div class="mb-4">
            <div class="row">
                <div class="col-md-6">
                    <input type="date" class="form-control" placeholder="Fecha mínima" wire:model.lazy="startDateFilter">
                </div>
                <div class="col-md-6">
                    <input type="date" class="form-control" placeholder="Fecha máxima" wire:model.lazy="endDateFilter">
                </div>
            </div>

        </div>

        <button class="btn btn-primary" wire:click="resetFilters">Resetear filtros</button>

        <div class="block">
            precio


        </div>


    </div>
    <h2 class="font-semibold text-xl text-gray-600 leading-tight">
        Ordenacion:
    </h2>
    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        <a href="#" wire:click = "sortBy('name')">Nombre</a>
    </th>
    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        <a href="#" wire:click = "sortBy('subcategory_id')">Category</a>
    </th>
    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        <a href="#" wire:click = "sortBy('price')">Precio</a>
    </th>
    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        <a href="#" wire:click = "sortBy('brand_id')">Marca</a>
    </th>
    <x-table-responsive>
        <div class="px-6 py-4">
            <x-jet-input class="w-full"
                         wire:model="search"
                         type="text"
                         placeholder="Introduzca el nombre del producto a buscar" />
        </div>

        @if($products->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">

                <tr>
                    @foreach($selectedColumns as $column)
                        <th>
                            @if(isset($columns[$column]))
                                <a href="#" wire:click.prevent="sortBy('{{ $column }}')">
                                    {{ $columns[$column] }}
                                    @if($sortField === $column)
                                        @if($sortDirection === 'asc')
                                            ▲
                                        @else
                                            ▼
                                        @endif
                                    @endif
                                </a>
                            @else
                                {{ $column }}
                            @endif
                        </th>
                    @endforeach
                </tr>
                <tr>

                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nombre
                        <button wire:click="sortCol('name', 'asc')">
                            <span class="fa fa-arrow-up"></span>  </button>
                        <button wire:click="sortCol('name', 'desc')">
                            <span class="fa fa-arrow-down"></span>
                        </button>
                    </th>

                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                       Estado
                        <button wire:click="sortCol('name', 'asc')">
                            <span class="fa fa-arrow-up"></span>  </button>
                        <button wire:click="sortCol('name', 'desc')">
                            <span class="fa fa-arrow-down"></span>
                        </button>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Precio
                        <button wire:click="sortCol('name', 'asc')">
                            <span class="fa fa-arrow-up"></span>  </button>
                        <button wire:click="sortCol('name', 'desc')">
                            <span class="fa fa-arrow-down"></span>
                        </button>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Categoria/Subcategoria
                        <button wire:click="sortCol('name', 'asc')">
                            <span class="fa fa-arrow-up"></span>  </button>
                        <button wire:click="sortCol('name', 'desc')">
                            <span class="fa fa-arrow-down"></span>
                        </button>
                    </th>

                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Marca
                        <button wire:click="sortCol('name', 'asc')">
                            <span class="fa fa-arrow-up"></span>  </button>
                        <button wire:click="sortCol('name', 'desc')">
                            <span class="fa fa-arrow-down"></span>
                        </button>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Vendidos
                        <button wire:click="sortCol('name', 'asc')">
                            <span class="fa fa-arrow-up"></span>  </button>
                        <button wire:click="sortCol('name', 'desc')">
                            <span class="fa fa-arrow-down"></span>
                        </button>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Stock
                        <button wire:click="sortCol('name', 'asc')">
                            <span class="fa fa-arrow-up"></span>  </button>
                        <button wire:click="sortCol('name', 'desc')">
                            <span class="fa fa-arrow-down"></span>
                        </button>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Creado
                        <button wire:click="sortCol('name', 'asc')">
                            <span class="fa fa-arrow-up"></span>  </button>
                        <button wire:click="sortCol('name', 'desc')">
                            <span class="fa fa-arrow-down"></span>
                        </button>
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Editar</span>
                    </th>
                </tr>
                </thead>
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
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $product->status == 1 ? 'red' : 'green'
                            }}-100 text-{{ $product->status == 1 ? 'red' : 'green' }}-800">
                                {{ $product->status == 1 ? 'Borrador' : 'Publicado' }}
                            </span>
                        </td>
@if($wtf)
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $product->price }} &euro;
                        </td>
                            @endif
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @foreach ($product->colors as $color)

                                    {{$color->name}}
                            @endforeach
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @foreach ($product->sizes as $size)
                                    {{$size->name}}
                                @endforeach
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">

                            </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div class="text-sm text-gray-900">{{ $product->subcategory->category->name }}</div>
                            <div class="text-sm text-gray-500">{{ $product->subcategory->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $product->brand->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $product->sold }}<br>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $product->stock }}<br>
                        </td>


                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">


                             {{ $product->created_at->format('d/m/Y') }}
                        </td>
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


        <div>
            <label for="perPage">Productos por página:</label>
            <select dusk="eje2" wire:model="perPage" id="perPage">
                <option  value="5" dusk="eje3">5</option>
                <option  value="10">10</option>
                <option  value="15">15</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>

        </div>




        <div>
            {{ $products->links() }}
        </div>



    </x-table-responsive>


</div>


