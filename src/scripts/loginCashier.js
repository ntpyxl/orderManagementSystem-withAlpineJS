async function loginUser(event) {
	event.preventDefault();

	const formData = Object.fromEntries(new FormData(event.target).entries());

	try {
		const response = await fetch(`${BASE_URL}/api/cashierManager.php`, {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
			},
			body: JSON.stringify({ action: "loginCashier", data: formData }),
		});

		const result = await response.json();

		if (response.ok) {
			Swal.fire({
				title: "Login success!",
				icon: "success",
				confirmButtonColor: "#14b8a6",
			}).then(() => {
				window.location.href = "index.php";
			});
		} else {
			throw result.message || "Something else went wrong!";
		}
	} catch (error) {
		Swal.fire({
			title: "Login failed!",
			text: error?.message || error || "Something else went wrong!",
			icon: "error",
			confirmButtonColor: "#ef4444",
		});
	}
}
