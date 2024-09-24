<div class="flex flex-col items-center h-3/4 p-6">
    <div class="flex flex-col justify-start w-4/5 h-full">
        <div class="title rounded-md bg-blue-600 text-center text-white text-2xl p-3 mb-3">Agregar Producto</div>
        <form class="flex flex-col justify-evenly h-full space-y-4" method="POST" action="{{ route('product.store') }}"
            enctype="multipart/form-data">
            @csrf
            <input type="text"
                class="bg-slate-200 rounded border-none w-3/4 p-3 @error('name') border-red-500 @enderror" id="name"
                name="name" maxlength="100" placeholder="Nombre" value="{{ old('name') }}" required />
            @error('name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            <input type="number"
                class="bg-slate-200 rounded border-none w-1/2 p-3 @error('price') border-red-500 @enderror"
                id="price" name="price" min="0" step="0.01" placeholder="Precio ($)"
                value="{{ old('price') }}" required />
            @error('price')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            <select class="bg-slate-200 rounded border-none w-1/2 p-3 @error('category') border-red-500 @enderror"
                id="category" name="category_id" required>
                <option value="0" selected disabled>Categoría</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                @endforeach
            </select>
            @error('category')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            <textarea class="bg-slate-200 rounded border-none w-3/4 p-3 @error('description') border-red-500 @enderror"
                id="description" name="description" placeholder="Descripción" rows="5" required>{{ old('description') }}</textarea>
            @error('description')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            <label
                class="block w-1/2 h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:bg-gray-100 flex items-center justify-center relative">
                <input type="file"
                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer @error('img') border-red-500 @enderror"
                    id="img" name="img" accept=".png, .jpg, .jpeg, .webp" required
                    onchange="updateFileName(this)">
                <div class="text-center">
                    <i class="bi bi-file-image text-4xl text-gray-400"></i>
                    <p id="file-name" class="mt-2 text-sm text-gray-600">Carga tu imagen</p>
                </div>
            </label>
            @error('img')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            <div class="flex flex-row-reverse flex-wrap">
                <button type="submit" class="primary-button rounded text-white p-2 w-1/5">Agregar
                    Producto</button>
            </div>
        </form>
    </div>
</div>

<script>
    function updateFileName(input) {
        const fileName = input.files[0].name;
        document.getElementById('file-name').innerText = fileName;
    }
</script>
