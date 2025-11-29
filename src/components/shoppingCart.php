<div id="shopingCart" class="col-span-12 md:col-span-3 h-screen top-0 sticky px-2 pt-5 bg-amber-50">
    <h2 class="px-5 text-2xl font-bold text-center">Shopping Cart</h2>

    <div class="border-2 border-gray-300 mx-2 mt-2 p-3 bg-white font-semibold h-1/2 md:h-2/3 overflow-y-auto">
        <div class="grid grid-cols-[7fr_2fr_3fr] px-1 py-2 gap-2 border-b border-gray-500 font-bold">
            <span class="text-left">Product Name</span>
            <span class="text-center">Quantity</span>
            <span class="text-right">Price</span>
        </div>

        <div id="cartListBody"></div>
    </div>

    <h2 class="my-1 px-5 text-xl font-semibold text-right">
        Total Amount:
        <span class="font-bold">
            PHP <span id="totalAmount">0.00</span>
        </span>
    </h2>

    <div class="flex flex-col mr-2 items-end space-y-3">
        <input type="number" id="userPayAmount" min="0" value="" class="px-3 py-1 w-5/8 border-2 rounded-xl focus:outline-none focus:ring-0">

        <div class="flex flex-row space-x-3">
            <button onclick="clearCart(event)" class="px-3 py-1 border-2 border-black rounded-4xl hover:bg-black hover:text-amber-50 duration-150 cursor-pointer select-none">Clear Cart</button>
            <button onclick="checkOutCart(event)" class="px-3 py-1 border-2 border-black rounded-4xl hover:bg-black hover:text-amber-50 duration-150 cursor-pointer select-none">Check Out</button>
        </div>
    </div>
</div>