function showComponent(event, section) {
	event.preventDefault();

	const sections = ["inventory", "cashiers", "transactions"];

	sections.forEach((name) => {
		$(`.${name}Component`).addClass("hidden");

		$(`#${name}NavButton`)
			.addClass("bg-amber-200")
			.removeClass("bg-amber-50");
	});

	$(`.${section}Component`).removeClass("hidden");

	$(`#${section}NavButton`)
		.addClass("bg-amber-50")
		.removeClass("bg-amber-200");
}
