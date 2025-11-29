<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixelshop</title>

    <link href="./styles.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-cyan-100">
    <div class="grid grid-cols-12">
        <div class="col-span-12 md:col-span-9">
            <?php include 'components/navbar.php'; ?>

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

                        <!-- Add to Cart (Customer Layout) -->
                        <div class="flex mt-8 mb-3 justify-between items-end">

                            <div class="flex flex-col">
                                <label class="ml-2">Quantity</label>
                                <input
                                    type="number"
                                    class="w-36 h-9 pl-3 pr-1 border-2 rounded-xl focus:outline-none focus:ring-0"
                                    x-model.number="item.quantity">
                            </div>

                            <button
                                class="px-3 py-1 border-2 border-black rounded-4xl hover:bg-black hover:text-amber-50 duration-150 cursor-pointer select-none"
                                @click="$dispatch('add-to-cart', item)">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <?php include 'components/shoppingCart.php'; ?>
    </div>


    <script src="scripts/script.js"></script>
    <script src="scripts/loadInventory.js"></script>
    <script src="scripts/cartHandler.js"></script>
</body>

</html>