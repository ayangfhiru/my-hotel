$(document).ready(function () {
	$(".switch-btn").on("click", function () {
		const isActive = $(this).hasClass("active");
		const facilityId = $(this).data("facility-id");
		const checkbox = $(
			'input.facility-checkbox[data-facility-id="' + facilityId + '"]'
		);

		if (isActive) {
			checkbox.prop("checked", true);
			console.log(facilityId);
		} else {
			checkbox.prop("checked", false);
		}
	});
});
