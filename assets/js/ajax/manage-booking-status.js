$(document).ready(function (e) {
	$(".manageBtn").click(function (e) {
		e.preventDefault();
		const btnValue = $(this).val();
		const url = $(this).data("url");
		const bookingDetId = $(this).data("id");
		console.log(`${url}booking/managementbooking/managestatus/${bookingDetId}`);

		$.ajax({
			url: `${url}booking/managementbooking/managestatus/${bookingDetId}`,
			type: "POST",
			data: {
				action: btnValue,
			},
			success: function (res) {
				if (res == "success") {
					location.reload();
				} else {
					console.log("Response: ", res);
				}
			},
			error: function (xhr, status, error) {
				console.log("Error details: ", error);
				console.log("Status: ", status);
				console.log("Response Text: ", xhr.responseText);
			},
		});
	});
});
