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