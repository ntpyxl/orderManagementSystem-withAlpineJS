<div class="px-6 pt-5 pb-3 space-x-2">
    <?php if($_SESSION['user_role'] === 'superadmin') { ?>
        <button id="cashiersAddCashierButton" class="px-3 py-1 border-2 border-black rounded-4xl hover:bg-black hover:text-amber-50 duration-150 cursor-pointer select-none">Add New Cashier</button>
    <?php } ?>
</div>

<div id="cashiersBody" class="flex flex-row flex-wrap px-10 py-5 justify-center"></div>

<script src="../scripts/loadCashiers.js"></script>