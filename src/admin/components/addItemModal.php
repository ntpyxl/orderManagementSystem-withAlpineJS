<div
  id="inventoryAddItemModal"
  class="hidden fixed inset-0 z-20 bg-black/50 backdrop-blur-sm justify-center items-center"
>
    <div class="bg-white px-6 py-4 rounded-2xl shadow-xl text-center relative">
        <h2 class="text-xl font-semibold mb-2">Cashier - Add Item</h2>
        <div class="border rounded-2xl p-6">
            <form id="addItemForm" onsubmit="inventoryAddItem(event)" class="space-y-3">
                <div class="flex">
                    <label for="itemNameField" class="text-right flex grow">Item Name</label>
                    <input
                        type="text"
                        id="itemNameField"
                        name="itemName"
                        class="w-96 ml-1 px-2 py-1 border"
                        required
                    >
                </div>

                <div class="flex">
                    <label for="itemImageField" class="text-right flex grow">Item Image</label>
                    <input
                        type="file"
                        accept="image/*"
                        id="itemImageField"
                        name="itemImage"
                        class="w-96 ml-1 px-2 py-1 border file:px-3 file:mr-2 file:border file:rounded-2xl cursor-pointer"
                        required
                    >
                </div>

                <div class="flex">
                    <label for="itemPriceField" class="text-right flex grow">Item Price</label>
                    <input
                        type="number"
                        id="itemPriceField"
                        name="itemPrice"
                        class="w-96 ml-1 px-2 py-1 border"
                        min="0"
                        required
                    >
                </div>
            </form>

            <div class="flex flex-col mt-4 justify-center items-center">
                <p class="font-medium mb-2">Image Preview</p>
                <img id="previewImage" class="w-56 h-56 object-contain rounded-xl border" alt="Preview" />
            </div>
        </div>

        <div class="flex mt-3 justify-end gap-3">
            <button
                id="inventoryAddItemSubmitButton"
                type="submit"
                form="addItemForm"
                class="px-3 py-1 border-2 border-black rounded-4xl hover:bg-black hover:text-amber-50 duration-150 cursor-pointer select-none"
            >
                Submit
            </button>

            <button
                id="inventoryAddItemCancelButton"
                class="px-3 py-1 border-2 border-black rounded-4xl hover:border-red-700 hover:bg-red-700 hover:text-amber-50 duration-150 cursor-pointer select-none"
            >
                Cancel
            </button>
        </div>
    </div>
</div>