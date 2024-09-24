@extends('layouts.app')

@section('content')

    <style>
        #cart-dropdown {
            display: none;
        }
    </style>

    <div class="flex flex-col justify-center items-center">
        @include('product.header')
        <div class="flex flex-col justify-center items-center w-4/5">
            <div class="title rounded-md text-center text-white text-2xl p-3 mb-5 w-full"> Detalles del producto </div>
            <div class="flex flex-row justify-between items-center w-1/2 mb-5">
                <img class="w-1/2 object-contain bg-slate-200 p-5 rounded-md"
                    src="data:image/jpeg;base64,{{ base64_encode($product->getImage()) }}" alt="product-img" />
                <div class="flex flex-col">
                    <span class="font-bold text-3xl mb-5"> {{ $product->name }} </span>
                    <span class="font-bold text-right text-xl"> ${{ $product->price }} </span>
                </div>
            </div>
            <p class="text-xl w-1/2 mb-5">{{$product->description}}</p>
            <button class="primary-button mt-4 text-white p-2 rounded w-1/4"
                                onclick="addToCart({{ $product->id }})">Agregar al carrito</button>
        </div>
    </div>

    <script>
        var products = @json($data);
        var shoppingCart = [];
        var userId = @json(auth()->user()->id);

        console.log(userId);

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
@endsection
