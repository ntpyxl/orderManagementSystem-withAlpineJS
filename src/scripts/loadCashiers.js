$(document).ready(function () {
	loadCashier();
});

async function loadCashier(search = "") {
	try {
		const data = await apiRequest(
			"getCashiers",
			{ search },
			"cashierManager"
		);

		if (!Array.isArray(data) || data.length === 0) {
			$("#cashiersBody").html(`
				<p class="text-gray-500 text-center">No records found</p>
			`);
			return;
		}

		const rows = data.map(createCashierRow).join("");
		$("#cashiersBody").html(rows);
	} catch (error) {
		console.error(error);
		$("#cashiersBody").html(`
			<p class="text-gray-500 text-center">Error loading data</p>
		`);
		toastFailed("Failed to load cashiers. Please try again.");
	}
}

function createCashierRow(cashier) {
	const image = `
				<img src="${BASE_URL}/assets/defaultUserImage.jpg" 
					alt="${cashier.first_name} ${cashier.last_name}" 
					class="w-32 aspect-square border text-center object-contain wrap-anywhere select-none"
				>`;

	const info = `
		<div class="flex flex-col w-full ml-3">
			<h5 class="font-bold text-lg">${cashier.first_name} ${cashier.last_name}</h5>
			<p class="">${cashier.user_role}</p>
		
			<div class="mt-2 wrap-anywhere">
				<p class="text-right">${cashier.user_email}</p>
				<p class="text-right">${cashier.contact_number}</p>
				<p class="text-right">${cashier.date_added}</p>
			</div>
		</div>
	`;

	let action = "";
	if (CURRENT_USER_ROLE === "superadmin") {
		if (cashier.user_status === "normal") {
			action = `
				<div class="flex w-full mt-3 space-x-0">
					<button
						class="flex-1 px-3 py-1 border-2 border-black bg-green-500 rounded-l-4xl cursor-pointer select-none"
					>
						Normal
					</button>
					<button
						onclick="changeUserStatus(${cashier.cashier_id}, 'suspend', '${CURRENT_CASHIER_ID}')"
						class="flex-1 px-3 py-1 border-2 border-black rounded-r-4xl hover:bg-black hover:text-red-500 duration-150 cursor-pointer select-none"
					>
						Suspended
					</button>
				</div>
			`;
		} else if (cashier.user_status === "suspended") {
			action = `
				<div class="flex w-full mt-3 space-x-0">
					<button
						onclick="changeUserStatus(${cashier.cashier_id}, 'unsuspend', '${CURRENT_CASHIER_ID}')"
						class="flex-1 px-3 py-1 border-2 border-black rounded-l-4xl hover:bg-black hover:text-amber-50 duration-150 cursor-pointer select-none"
					>
						Normal
					</button>
					<button
						class="flex-1 px-3 py-1 border-2 border-black bg-red-500 rounded-r-4xl cursor-pointer select-none"
					>
						Suspended
					</button>
				</div>
			`;
		}
	}
	return `
		<div class="flex flex-col m-3 w-92 h-full p-3 rounded-xl bg-amber-50 drop-shadow-lg">
			<div class="flex flex-row">
				<div class="px-2 rounded-xl w-fit">
					<p><b>ID:</b> ${cashier.cashier_id}</p>
					${image}
				</div>

				${info}
			</div>

			${action}
		</div>
	`;
}
