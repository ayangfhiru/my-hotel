$(document).ready(function () {
	$(".dateSchedule").click(function () {
		const date = $(this).data("date");
		const baseUrl = window.location.origin;
		console.log(`${baseUrl}/schedule/findBooking`);

		if (date !== "") {
			$.ajax({
				url: `${baseUrl}/schedule/findBooking`,
				type: "POST",
				data: {
					start_date: date,
					end_date: date,
				},
				dataType: "json",
				success: function (response) {
					console.log(response);
				},
				error: function (xhr, status, error) {
					console.log("Error:", error);
				},
			});
		}
	});
});
