$("#cashiersAddCashierButton").on("click", function (event) {
	event.preventDefault();
	$("#cashiersAddCashierModal").addClass("flex").removeClass("hidden");
	$("body").addClass("overflow-hidden");
});

$("#cashiersAddCashierCancelButton").on("click", function (event) {
	event.preventDefault();
	closeAddCashierModal();
});

function closeAddCashierModal() {
	$("#cashiersAddCashierModal").addClass("hidden").removeClass("flex");
	$("body").removeClass("overflow-hidden");
}

async function cashiersAddCashier(event) {
	event.preventDefault();

	const formData = Object.fromEntries(new FormData(event.target).entries());

	try {
		await apiRequest("addCashier", formData, "cashierManager");

		toastSuccess("Successfully added cashier!");
		loadCashier();
	} catch (error) {
		toastFailed(error?.message || "Failed to add new cashier!");
	}

	event.target.reset();
	closeAddCashierModal();
}

async function changeUserStatus(cashierId, status, currentCashierId) {
	currentCashierId = parseInt(currentCashierId);
	const formData = {
		cashier_id: cashierId,
		new_cashier_status: status,
	};

	try {
		if (currentCashierId === cashierId) {
			throw "You cannot change your own account status!";
		}

		const cashierData = await apiRequest(
			"getCashierById",
			formData,
			"cashierManager"
		);
		const confirmed = await confirmAction(
			`Are you sure you want to ${status} ${cashierData.first_name} ${cashierData.last_name}?`
		);

		if (!confirmed) return;

		await apiRequest("changeCashierStatus", formData, "cashierManager");
		toastSuccess(
			`${cashierData.first_name} ${cashierData.last_name} is now ${status}ed!`
		);

		loadCashier();
	} catch (error) {
		alertError(error);
	}
}
