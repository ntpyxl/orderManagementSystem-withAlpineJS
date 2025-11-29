async function loadInventory(search = "", layout = "customer") {
	try {
		const data = await apiRequest(
			"getInventoryItems",
			{ search },
			"inventoryManager"
		);

		if (!Array.isArray(data) || data.length === 0) {
			$("#inventoryBody").html(`
				<p class="text-gray-500 text-center">No records found</p>
			`);
			return;
		}

		const rows = data
			.map((item) => createInventoryCard(item, layout))
			.join("");
		$("#inventoryBody").html(rows);
	} catch (error) {
		console.error(error);
		$("#inventoryBody").html(`
			<p class="text-gray-500 text-center">Error loading data</p>
		`);
		toastFailed("Failed to load inventory. Please try again.");
	}
}

function createInventoryCard(item, layout) {
	const image = `<img src="${BASE_URL}/images/${item.item_image}" 
					alt="${item.item_name}" 
					class="w-56 aspect-square border text-center object-contain select-none">`;

	const info = `
		<h5 class="font-bold text-xl">${item.item_name}</h5>
		<p class="text-xl text-right">PHP ${item.price}</p>
	`;

	let action = "";
	if (layout === "customer") {
		action = `
			<form onsubmit="addToCart(event)" class="flex mt-8 mb-3 justify-between items-end">
				<input type="hidden" name="itemId" value="${item.item_id}">
				<input type="hidden" name="itemName" value="${item.item_name}">
				<input type="hidden" name="itemPrice" value="${item.price}">
				<div class="flex flex-col">
					<label for="itemQuantityField" class="ml-2">Quantity</label>
					<input type="number" id="itemQuantityField" name="itemQuantity" class="w-36 h-9 pl-3 pr-1 border-2 rounded-xl focus:outline-none focus:ring-0">
				</div>
				<button class="px-3 py-1 border-2 border-black rounded-4xl hover:bg-black hover:text-amber-50 duration-150 cursor-pointer select-none">
					Add to Cart
				</button>
			</form>
		`;
	}

	return `
		<div class="flex flex-col m-3 w-72 h-full p-3 rounded-xl bg-amber-50 drop-shadow-lg">
			<div class="mx-auto my-3 p-2 rounded-xl w-fit">${image}</div>
			${info}
			${action}
		</div>
	`;
}
