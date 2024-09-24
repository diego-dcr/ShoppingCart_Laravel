@php
    $changeBG = false;
@endphp
<div class="flex flex-col justify-center items-center">
    <div class="flex flex-col justify-center w-4/5">
        <div class="title rounded-md text-center text-white text-2xl p-3 mb-3"> Productos</div>

        <div class="flex flex-row justify-between mb-3">
            <a href="{{ route('product.create') }}" class="primary-button text-white font-bold py-2 px-4 rounded">
                <i class="bi bi-plus-lg"></i> Agregar Producto
            </a>
            <form class="flex" method="GET" action="{{ route('product.search') }}" enctype="multipart/form-data">
                <div class="flex justify-center items-center">
                    <label class="me-2 text-center">Buscar</label>
                </div>
                <input type="text" id="search" name="search"
                    class="w-full px-4 p-2 border-none rounded-md bg-slate-200 focus:ring-1 focus:ring-blue-500 focus:border-transparent"
                    maxlength="25" />
                <button class="ml-2 text-black hover:text-blue-600 text-xl">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        <div class="grid grid-cols-4 title rounded-md text-center text-white text-xl mb-2 p-2 pt-0 pb-0"
            id="table-head">
            <span class="">Imagen</span>
            <span class="">Nombre</span>
            <span class="">Precio</span>
            <span class="">Acciones</span>
        </div>

        @foreach ($products as $product)
            <div class="grid grid-cols-4 rounded-md text-center text-l mb-2 {{ $changeBG ? '' : 'bg-slate-200' }} p-2"
                id="table-body">
                <div class="flex flex-row justify-center items-center">
                    <img class="w-2/5 object-contain"
                        src="data:image/jpeg;base64,{{ base64_encode($product->getImage()) }}" alt="product-img" />
                </div>
                <div class="flex flex-row justify-center items-center">{{ $product->name }}</div>
                <div class="flex flex-row justify-center items-center">{{ $product->category->name }}</div>
                <div class="flex flex-row justify-evenly items-center">
                    <a href="{{ route('product.edit', ['id' => $product->id]) }}"
                        class="primary-button text-white font-bold py-2 px-4 rounded text-base" id="">
                        <i class="bi bi-pencil-square"></i> Editar
                    </a>

                    <form action="{{ route('product.destroy', ['id' => $product->id]) }}" method="POST"
                        style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');"
                            class="primary-button text-white font-bold py-2 px-4 rounded text-base">
                            <i class="bi bi-trash-fill"></i> Eliminar
                        </button>
                    </form>

                </div>
            </div>
            @php
                $changeBG = !$changeBG;
            @endphp
        @endforeach

    </div>
</div>
