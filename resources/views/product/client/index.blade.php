@php
    $data = [];

    foreach ($products as $product) {
        $data[] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'src' => 'data:image/jpeg;base64,' . base64_encode($product->getImage()),
        ];
    }

@endphp

<style>
    #cart-dropdown {
        display: none;
    }
</style>

<div class="flex flex-col justify-center items-center">
    @include('product.header')
    <div class="flex flex-col justify-center w-4/5">
        <span class="text-xl mb-3">Agrega a tu carrito los articulos que deseas comprar</span>

        <div class="grid grid-cols-6 gap-4 mb-3">
            @foreach ($categories as $category)
                <a href=" {{ route('shopping.search', ['categoryId' => $category->id]) }}"
                    class="bg-slate-200 text-center rounded p-2 hover:bg-slate-300">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        <div class="grid grid-cols-4 gap-4">
            @foreach ($products as $product)
                <div class="bg-slate-200 p-4 rounded-lg shadow-md" id="card">
                    <a href="{{ route('shopping.show', ['id' => $product->id]) }}">
                        <img src="data:image/jpeg;base64,{{ base64_encode($product->getImage()) }}"
                            alt="{{ $product->name }}" class="w-full h-48 object-cover mb-4 rounded-t-lg">
                    </a>
                    <div class="bg-white p-2 rounded-b-lg">
                        <h2 class="text-xl mb-2">{{ $product->name }}</h2>
                        <p class="text-lg font-bold">${{ $product->price }}</p>
                    </div>
                    <div class="flex justify-center">
                        <button class="primary-button mt-4 text-white p-2 rounded w-3/4"
                            onclick="addToCart({{ $product->id }})">Agregar</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    var products = @json($data);
    var shoppingCart = [];
    var userId = @json(auth()->user()->id);

    function showCart() {
        if ($('#cart-dropdown').is(':visible')) {
            $('#cart-dropdown').hide();
        } else {
            $('#cart-dropdown').show();
            setShoppingCart();
        }
    }

    function addToCart(product_id) {
        var product = shoppingCart.find(item => item.productId == product_id);
        if (product) {
            product.count++
        } else {
            shoppingCart.push({
                productId: product_id,
                count: 1,
            });
        }

        console.log(shoppingCart);
        setShoppingCart();
        saveCartToLocalStorage();
    }

    function removeFromCart(product_id) {
        var index = shoppingCart.findIndex(item => item.productId == product_id);
        if (index != -1) {
            if (shoppingCart[index].count == 1) {
                shoppingCart.splice(index, 1);
            } else {
                shoppingCart[index].count--;
            }
        }
        console.log(shoppingCart);
        setShoppingCart();
        saveCartToLocalStorage();
    }

    function countCart() {
        $('#cart-count').html(shoppingCart.length > 0 ? shoppingCart.length : 0);
    }

    function setShoppingCart() {
        var html = '';
        var cost = 0;

        products.forEach(product => {
            var productInCart = shoppingCart.find(item => item.productId == product.id);
            if (productInCart) {
                html += `
                        <div class="flex flex-row bg-slate-200 p-2">
                            <div class="w-30 h-20 overflow-hidden rounded">
                                <img src="${product.src}" alt="product-image" class="object-contain w-full h-full">
                            </div>
                            <div class="flex flex-col justify-between ml-4 w-full">
                                <span>${product.name}</span>
                                <div class="flex flex-row justify-between w-full">
                                    <span>$ ${product.price}</span>
                                    <div class="flex flex-row justify-between bg-white rounded-lg w-1/4">
                                        <button class="pl-2" onclick="addToCart(${product.id})">+</button>
                                        <span>${productInCart.count}</span>
                                        <button class="pr-2" onclick="removeFromCart(${product.id})">-</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                cost += productInCart.count * product.price;
                cost = Math.round(cost * 100) / 100;
            }
        });

        if (shoppingCart.length <= 0) {
            html = `<p class="text-red-600"> Carrito vacio </p>`;
        } else {
            html += `
                    <div class="flex flex-row justify-between w-full">
                        <span class="text-primary font-bold">Total</span>  
                        <span class="text-primary font-bold">$ ${cost}</span>  
                    </div>
                    <button class="primary-button mt-4 text-white p-2 rounded"
                                onclick="alert('Carrito comprado')">Comprar ahora</button>
                `;
        }

        countCart()
        $('#cart-container').html(html);
    }

    function saveCartToLocalStorage() {
        localStorage.setItem(`shoppingCart_${userId}`, JSON.stringify(shoppingCart));
    }

    function loadCartFromLocalStorage() {
        var savedCart = localStorage.getItem(`shoppingCart_${userId}`);
        if (savedCart) {
            shoppingCart = JSON.parse(savedCart);
        }
    }

    $(document).ready(function() {
        loadCartFromLocalStorage();
        setShoppingCart();
    });
</script>
