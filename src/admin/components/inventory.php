<div class="px-6 pt-5 pb-3 space-x-2">
    <button id="inventoryAddItemButton" class="px-3 py-1 border-2 border-black rounded-4xl hover:bg-black hover:text-amber-50 duration-150 cursor-pointer select-none">Add Item</button>
</div>

<div
    x-data="inventoryComponent()"
    x-init="loadInventory()"
    class="flex flex-row flex-wrap mx-12 mt-8 justify-center">
    <!-- Loading State -->
    <template x-if="loading">
        <p class="text-gray-500 text-center">Loading items...</p>
    </template>

    <!-- Error State -->
    <template x-if="error">
        <p class="text-red-500 text-center">Error</p>
    </template>

    <!-- No Results -->
    <template x-if="!loading && !error && items.length === 0">
        <p class="text-gray-500 text-center">No records found</p>
    </template>

    <!-- Inventory List -->
    <template x-for="item in items" :key="item.item_id">
        <div class="flex flex-col m-3 w-72 h-full p-3 rounded-xl bg-amber-50 drop-shadow-lg">

            <div class="mx-auto my-3 p-2 rounded-xl w-fit">
                <img
                    :src="`${BASE_URL}/images/${item.item_image}`"
                    :alt="item.item_name"
                    class="w-56 aspect-square border text-center object-contain select-none">
            </div>

            <h5 class="font-bold text-xl" x-text="item.item_name"></h5>
            <p class="text-xl text-right">PHP <span x-text="item.price"></span></p>
        </div>
    </template>
</div>

<script src="../scripts/loadInventory.js"></script>