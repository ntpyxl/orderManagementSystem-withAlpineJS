<div class="flex flex-row px-6 pt-5 pb-3 space-x-2 items-end">
    <button
        id="transactionsPrintHistory"
        onclick="window.print()"
        class="px-3 py-1 border-2 border-black rounded-4xl hover:bg-black hover:text-amber-50 duration-150 cursor-pointer select-none print:hidden"
    >
        Print Transactions
    </button>

    <div id="startDateSortDiv" class="flex flex-col print:hidden">
        <label for="startDateSort" class="ml-3">Sort Start Date</label>
        <input
            id="startDateSort"
            type="date"
            class="w-40 px-3 py-1 border-2 border-black rounded-4xl focus:outline-none"
        >
    </div>

    <div id="endDateSortDiv" class="flex flex-col print:hidden">
        <label for="endDateSort" class="ml-3">Sort End Date</label>
        <input
            id="endDateSort"
            type="date"
            class="w-40 px-3 py-1 border-2 border-black rounded-4xl focus:outline-none"
        >
    </div>
</div>

<div class="flex flex-row flex-wrap px-10 py-5 justify-center">
    <table>
        <thead>
            <tr>
                <th class="border px-2">ID</th>
                <th class="border px-2">Item ID</th>
                <th class="border px-2">Item Name</th>
                <th class="border px-2">Item Price</th>
                <th class="border px-2">Item Quantity</th>
                <th class="border px-2">Total Price</th>
                <th class="border px-2">Date Transacted</th>
            </tr>
        </thead>
        <tbody id="transactionHistoryBody"></tbody>
    </table>
</div>

<script src="../scripts/loadTransactions.js"></script>
<script>
    $(document).ready(function () {
        loadTransactions();
    });
</script>