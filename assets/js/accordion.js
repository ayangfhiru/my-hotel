function toggleAccordion(index) {
	event.preventDefault();
	const content = $(`#content-${index}`);
	const icon = $(`#icon-${index}`);

	const minusSVG = `
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
        <path d="M3.75 7.25a.75.75 0 0 0 0 1.5h8.5a.75.75 0 0 0 0-1.5h-8.5Z" />
      </svg>`;

	const plusSVG = `
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
        <path d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
      </svg>`;

	if (
		content.css("max-height") !== "0px" &&
		content.css("max-height") !== "none"
	) {
		content.css("max-height", "0");
		icon.html(plusSVG);
	} else {
		content.css("max-height", content[0].scrollHeight + "px");
		icon.html(minusSVG);
	}
}
