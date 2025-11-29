const BASE_URL = `${window.location.origin}/orderManagementSystem/src/`;
let cart = [];

async function apiRequest(action, data, api) {
	const response = await fetch(`${BASE_URL}/api/${api}.php`, {
		method: "POST",
		headers: { "Content-Type": "application/json" },
		body: JSON.stringify({ action, data }),
	});

	const result = await response.json();
	if (!response.ok || result.success === false) {
		throw new Error(result.message || "Request failed");
	}
	return result.data;
}

async function confirmAction(title, confirmText = "Yes", denyText = "No") {
	const result = await Swal.fire({
		title,
		showDenyButton: true,
		confirmButtonText: confirmText,
		confirmButtonColor: "#14b8a6",
		denyButtonText: denyText,
		customClass: {
			title: "text-lg",
			actions: "my-actions",
			confirmButton: "order-1",
			denyButton: "order-2",
		},
	});

	return result.isConfirmed;
}

function alertSuccess(title) {
	Swal.fire({
		title: title,
		icon: "success",
		confirmButtonColor: "#14b8a6",
	});
}

function alertError(error) {
	Swal.fire({
		title: "Something went wrong!",
		text: error?.message || error || "Something else went wrong!",
		icon: "error",
		confirmButtonColor: "#ef4444",
	});
}

function toastSuccess(message) {
	Swal.fire({
		toast: true,
		position: "bottom-start",
		icon: "success",
		title: message,
		showConfirmButton: false,
		timer: 2500,
		timerProgressBar: true,
		background: "#fef3c7",
		color: "#1f2937",
	});
}

function toastFailed(message) {
	Swal.fire({
		toast: true,
		position: "bottom-start",
		icon: "error",
		title: message,
		showConfirmButton: false,
		timer: 2500,
		timerProgressBar: true,
		background: "#fee2e2",
		color: "#7f1d1d",
	});
}
