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

$("#itemImageField").on("change", function (event) {
	const file = event.target.files[0];
	if (file) {
		const previewUrl = URL.createObjectURL(file);
		$("#previewImage").attr("src", previewUrl);
	} else {
		$("#previewImage").attr("src", "");
	}
});

async function inventoryAddItem(event) {
	event.preventDefault();

	const formData = Object.fromEntries(new FormData(event.target).entries());
	formData.itemPrice = parseInt(formData.itemPrice);

	try {
		const uploadResult = await uploadItemImage();
		if (!uploadResult.success) {
			throw new Error(uploadResult.message || "Image upload failed");
		}

		formData.itemImage = uploadResult.fileName;

		await apiRequest("addItem", formData, "inventoryManager");

		toastSuccess("Successfully added item!");
		loadInventory(search = "", layout = "admin");

		event.target.reset();
		$("#previewImage").attr("src", "");
	} catch (error) {
		toastFailed(error?.message || "Failed to add item!");
	}

	closeAddItemModal();
	event.target.reset();
}

async function uploadItemImage() {
	const itemImage = $("#itemImageField")[0].files[0];
	if (!itemImage) return { success: false, message: "No image selected" };

	const formData = new FormData();
	formData.append("action", "uploadItemImage");
	formData.append("itemImage", itemImage);

	try {
		const response = await fetch(`${BASE_URL}/api/inventoryManager.php`, {
			method: "POST",
			body: formData,
		});
		const result = await response.json();

		if (!response.ok || !result.success) {
			throw new Error(result.message || "Image upload failed");
		}
		return result;
	} catch (error) {
		console.error("Upload error:", error);
		return { success: false, message: error?.message || error };
	}
}
