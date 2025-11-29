<div class="px-6 pt-5 pb-3 space-x-2">
    <button id="inventoryAddItemButton" class="px-3 py-1 border-2 border-black rounded-4xl hover:bg-black hover:text-amber-50 duration-150 cursor-pointer select-none">Add Item</button>
</div>

<div id="inventoryBody" class="flex flex-row flex-wrap px-10 py-5 justify-center">
</div>

<script src="../scripts/loadInventory.js"></script>
<script>
    $(document).ready(function () {
        loadInventory(search = "", layout = "admin");
    });
</script>