$(document).ready(function () {
	function checkAndSendRequest() {
		const checkIn = $("#check_in").val();
		const checkOut = $("#check_out").val();
		const baseUrl = window.location.origin;

		if (checkIn !== "" && checkOut !== "") {
			$.ajax({
				url: `${baseUrl}/room/findAvaiableRooms`,
				type: "POST",
				data: {
					check_in: checkIn,
					check_out: checkOut,
				},
				dataType: "json",
				success: function (response) {
					if (Array.isArray(response) && response.length > 0) {
						$("#room_code").empty();
						$("#room_code").append('<option value="">Pilih Room</option>');
						$.each(response, function (index, room) {
							$("#room_code").append(
								'<option value="' +
									room.room_code_id +
									'">' +
									room.room_type +
									" | " +
									room.room_code +
									"</option>"
							);
						});
					} else {
						$("#room_code").append(
							'<option value="">Tidak ada room tersedia</option>'
						);
					}
				},
				error: function (xhr, status, error) {
					console.log("Error:", error);
				},
			});
		}
	}

	$("#check_in, #check_out").on("change", function () {
		checkAndSendRequest();
	});
});
