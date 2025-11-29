function addToCart(event) {
	event.preventDefault();

	const formData = Object.fromEntries(new FormData(event.target).entries());
	formData.itemPrice = parseInt(formData.itemPrice);
	formData.itemQuantity = parseInt(formData.itemQuantity);

	if (!formData.itemQuantity || formData.itemQuantity <= 0) {
		return;
	}

	const existingItem = cart.find(
		(item) => item.itemName === formData.itemName
	);

	if (existingItem) {
		existingItem.itemQuantity += formData.itemQuantity;
	} else {
		cart.push(formData);
	}

	updateCartDisplay();
}

function clearCart(event) {
	event.preventDefault();

	cart = [];
	$("#userPayAmount").val("");

	updateCartDisplay();
}

async function checkOutCart(event) {
	event.preventDefault();

	const payAmount = parseInt($("#userPayAmount").val());

	if (!payAmount || payAmount <= 0) {
		return;
	}

	const total = cart.reduce(
		(sum, item) => sum + item.itemPrice * item.itemQuantity,
		0
	);

	if (payAmount >= total) {
		const formData = cart;

		try {
			await apiRequest("checkOutCart", formData, "transactionManager");

			Swal.fire({
				title: "Thank you for purchasing from Pixelshop!",
				text: `Your change is PHP ${payAmount - total}`,
				icon: "success",
				confirmButtonColor: "#14b8a6",
			}).then(clearCart(event));
		} catch (error) {
			alertError(error);
		}
	} else {
		Swal.fire({
			title: "You have insufficient funds!",
			text: `You are missing PHP ${total - payAmount}!`,
			icon: "error",
			confirmButtonColor: "#ef4444",
		});
	}
}

function updateCartDisplay() {
	$("#cartListBody").html(cart.map((item) => createItemRow(item)).join(""));

	const total = cart.reduce(
		(sum, item) => sum + item.itemPrice * item.itemQuantity,
		0
	);

	$("#totalAmount").text(total.toFixed(2));
}

function createItemRow(item) {
	return `
        <div class="grid grid-cols-[7fr_2fr_3fr] px-1 py-1 gap-2 border-gray-500">
            <span class="text-left">
                ${item.itemName} @ ${item.itemPrice} PHP
            </span>
            <span class="text-center">x${item.itemQuantity}</span>
            <span class="text-right">
                ${item.itemPrice * item.itemQuantity} PHP
            </span>
        </div>
    `;
}
