<div class="flex flex-col justify-center w-full">
    <div class="flex flex-row justify-end p-3 mb-3">
        <div class="flex flex-row justify-between items-center w-1/5 mr-4">
            <span class="text-2xl">Hola {{ auth()->user()->name }}</span>
            <button class="relative mr-8" onclick="showCart()">
                <span class="text-2xl"><i class="bi bi-cart2"></i></span>
                <span
                    class="absolute left-6 top-0 right-0 text-white rounded-full text-xs flex items-center justify-center w-5 h-5 count"
                    id="cart-count"></span>
            </button>
        </div>
    </div>
    <div id="cart-dropdown"
        class="absolute right-5 top-14 mt-3 p-4 bg-slate-100 border rounded-lg shadow-lg w-1/5 hidden">
        <!-- Contenido del carrito de compras -->
        <h3 class="text-xl font-bold mb-2 text-center">Mi carrito</h3>
        <div class="grid grid-cols-1 gap-4" id="cart-container"></div>
    </div>
</div>