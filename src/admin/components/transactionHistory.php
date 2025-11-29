<div
    x-init="loadTransactions()"
    class="flex flex-row px-6 pt-5 pb-3 space-x-2 items-end">
    <button
        id="transactionsPrintHistory"
        onclick="window.print()"
        class="px-3 py-1 border-2 border-black rounded-4xl hover:bg-black hover:text-amber-50 duration-150 cursor-pointer select-none print:hidden">
        Print Transactions
    </button>

    <div id="startDateSortDiv" class="flex flex-col print:hidden">
        <label for="startDateSort" class="ml-3">Sort Start Date</label>
        <input
            id="startDateSort"
            type="date"
            x-model="startDate"
            @input="updateStartDate()"
            class="w-40 px-3 py-1 border-2 border-black rounded-4xl focus:outline-none">
    </div>

    <div id="endDateSortDiv" class="flex flex-col print:hidden">
        <label for="endDateSort" class="ml-3">Sort End Date</label>
        <input
            id="endDateSort"
            type="date"
            x-model="endDate"
            @input="updateEndDate()"
            class="w-40 px-3 py-1 border-2 border-black rounded-4xl focus:outline-none">
    </div>
</div>

<div class="flex flex-row flex-wrap px-10 py-5 justify-center">
    <table>
        <tr>
            <th class="border px-2">ID</th>
            <th class="border px-2">Item ID</th>
            <th class="border px-2">Item Name</th>
            <th class="border px-2">Item Price</th>
            <th class="border px-2">Item Quantity</th>
            <th class="border px-2">Total Price</th>
            <th class="border px-2">Date Transacted</th>
        </tr>


        <!-- Loading State -->
        <template x-if="loading">
            <tr>
                <td colspan="7" class="text-center text-gray-500">
                    Loading transaction history...
                </td>
            </tr>
        </template>

        <!-- Error State -->
        <template x-if="error">
            <tr>
                <td colspan="7" class="text-center text-red-500">
                    Error
                </td>
            </tr>
        </template>

        <!-- No Results -->
        <template x-if="!loading && !error && transactions.length === 0">
            <tr>
                <td colspan="7" class="text-center text-gray-500">
                    No transactions found
                </td>
            </tr>
        </template>

        <template x-for="transaction in transactions" :key="transaction.transaction_id">
            <tr>
                <td class="border px-2" x-text="transaction.transaction_id"></td>
                <td class="border px-2" x-text="transaction.item_id"></td>
                <td class="border px-2" x-text="transaction.item_name"></td>
                <td class="border px-2" x-text="transaction.price"> PHP</td>
                <td class="border px-2" x-text="transaction.item_quantity"></td>
                <td class="border px-2" x-text="transaction.price * transaction.item_quantity"> PHP</td>
                <td class="border px-2" x-text="transaction.date_transacted"></td>
            </tr>
        </template>

        <!-- Total Row -->
        <template x-if="transactions.length > 0 && !loading && !error">
            <tr>
                <td colspan="7" class="h-3 border bg-black"></td>
            </tr>
        </template>

        <template x-if="transactions.length > 0 && !loading && !error">
            <tr>
                <td colspan="3" class="border px-2"></td>
                <td colspan="2" class="border px-2 font-bold">TRANSACTIONS TOTAL:</td>
                <td class="border px-2 font-bold" x-text="totalAmount + ' PHP'"></td>
                <td class="border px-2"></td>
            </tr>
        </template>
    </table>
</div>