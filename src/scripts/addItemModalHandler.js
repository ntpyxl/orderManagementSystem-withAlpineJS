$("#inventoryAddItemButton").on("click", function (event) {
	event.preventDefault();
	$("#inventoryAddItemModal").addClass("flex").removeClass("hidden");
	$("body").addClass("overflow-hidden");
});

$("#inventoryAddItemCancelButton").on("click", function (event) {
	event.preventDefault();
	closeAddItemModal();
});

function closeAddItemModal() {
	$("#inventoryAddItemModal").addClass("hidden").removeClass("flex");
	$("body").removeClass("overflow-hidden");
}