let startDateSort = "";
let endDateSort = "";

$("#startDateSort").on("input", function () {
	if ($(this).val()) {
		startDateSort = `${$(this).val()} 00:00:00`;
		$("#startDateSortDiv").removeClass("print:hidden");
	} else {
		startDateSort = "";
		$("#startDateSortDiv").addClass("print:hidden");
	}

	loadTransactions(startDateSort, endDateSort);
});

$("#endDateSort").on("input", function () {
	if ($(this).val()) {
		endDateSort = `${$(this).val()} 23:59:59`;
		$("#endDateSortDiv").removeClass("print:hidden");
	} else {
		endDateSort = "";
		$("#endDateSortDiv").addClass("print:hidden");
	}
	loadTransactions(startDateSort, endDateSort);
});

async function loadTransactions(startDateSort = "", endDateSort = "") {
	try {
		let formData = {};
		if (startDateSort) {
			console.log(startDateSort);
			formData.start_date_sort = startDateSort;
		}
		if (endDateSort) {
			console.log(endDateSort);
			formData.end_date_sort = endDateSort;
		}

		const data = await apiRequest(
			"getTransactionHistory",
			formData,
			"transactionManager"
		);

		if (!Array.isArray(data) || data.length === 0) {
			$("#transactionHistoryBody").html(`
				<tr><td colspan="7" class="text-gray-500 text-center">No records found</td></tr>
			`);
			return;
		}

		let rows = data
			.map((transaction) => createTransactionRow(transaction))
			.join("");

		const total = data.reduce(
			(sum, item) => sum + item.price * item.item_quantity,
			0
		);
		rows += `
            <tr>
                <td colspan="7" class="h-3 border bg-black"></td>
            </tr>
            <tr>
                <td colspan="3" class="border px-2"></td>
                <td colspan="2" class="border px-2 font-bold">TRANSACTIONS TOTAL: </td>
                <td class="border px-2 font-bold">${total} PHP</td>
                <td class="border px-2"></td>
            </tr>
        `;

		$("#transactionHistoryBody").html(rows);
	} catch (error) {
		console.error(error);
		$("#transactionHistoryBody").html(`
			<tr><td class="col-span-full text-gray-500 text-center">Error loading data</td></tr>
		`);
		toastFailed("Failed to load transaction history. Please try again.");
	}
}

function createTransactionRow(transaction) {
	return `
        <tr>
            <td class="border px-2">${transaction.transaction_id}</td>
            <td class="border px-2">${transaction.item_id}</td>
            <td class="border px-2">${transaction.item_name}</td>
            <td class="border px-2">${transaction.price} PHP</td>
            <td class="border px-2">${transaction.item_quantity}</td>
            <td class="border px-2">
                ${transaction.price * transaction.item_quantity} PHP
            </td>
            <td class="border px-2">${transaction.date_transacted}</td>
        </tr>
    `;
}
