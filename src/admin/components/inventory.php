<div class="px-6 pt-5 pb-3 space-x-2">
    <button
        id="inventoryAddItemButton"
        class="px-3 py-1 border-2 border-black rounded-4xl hover:bg-black hover:text-amber-50 duration-150 cursor-pointer select-none">
        Add Item
    </button>
</div>

<div
    x-init="loadInventory()"
    class="flex flex-row flex-wrap mx-12 mt-8 justify-center">
    <!-- Loading State -->
    <template x-if="loading">
        <p class="text-gray-500 text-center">Loading inventory...</p>
    </template>

    <!-- Error State -->
    <template x-if="error">
        <p class="text-red-500 text-center">Error</p>
    </template>

    <!-- No Results -->
    <template x-if="!loading && !error && items.length === 0">
        <p class="text-gray-500 text-center">No items found</p>
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



<div
    id="inventoryAddItemModal"
    class="hidden fixed inset-0 z-20 bg-black/50 backdrop-blur-sm justify-center items-center">
    <div class="bg-white px-6 py-4 rounded-2xl shadow-xl text-center relative">
        <h2 class="text-xl font-semibold mb-2">Cashier - Add Item</h2>
        <div class="border rounded-2xl p-6">
            <form
                id="addItemForm"
                @submit.prevent="submitForm"
                class="space-y-3">
                <div class="flex">
                    <label for="itemNameField" class="text-right flex grow">Item Name</label>
                    <input
                        type="text"
                        id="itemNameField"
                        x-model="form.itemName"
                        name="itemName"
                        class="w-96 ml-1 px-2 py-1 border"
                        required>
                </div>

                <div class="flex">
                    <label for="itemImageField" class="text-right flex grow">Item Image</label>
                    <input
                        type="file"
                        accept="image/*"
                        id="itemImageField"
                        x-model="form.itemImage"
                        name="itemImage"
                        @change="handleImageFile"
                        class="w-96 ml-1 px-2 py-1 border file:px-3 file:mr-2 file:border file:rounded-2xl cursor-pointer"
                        required>
                </div>

                <div class="flex">
                    <label for="itemPriceField" class="text-right flex grow">Item Price</label>
                    <input
                        type="number"
                        id="itemPriceField"
                        x-model.number="form.itemPrice"
                        name="itemPrice"
                        min="0"
                        class="w-96 ml-1 px-2 py-1 border"
                        required>
                </div>
            </form>

            <div class="flex flex-col mt-4 justify-center items-center">
                <p class="font-medium mb-2">Image Preview</p>
                <img
                    id="previewImage"
                    :src="previewImage"
                    class="w-56 h-56 object-contain rounded-xl border"
                    alt="Preview Image" />
            </div>
        </div>

        <div class="flex mt-3 justify-end gap-3">
            <button
                id="inventoryAddItemSubmitButton"
                @click="addItem()"
                class="px-3 py-1 border-2 border-black rounded-4xl hover:bg-black hover:text-amber-50 duration-150 cursor-pointer select-none">
                Submit
            </button>

            <button
                id="inventoryAddItemCancelButton"
                class="px-3 py-1 border-2 border-black rounded-4xl hover:border-red-700 hover:bg-red-700 hover:text-amber-50 duration-150 cursor-pointer select-none">
                Cancel
            </button>
        </div>
    </div>
</div>