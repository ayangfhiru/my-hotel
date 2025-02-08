$(document).ready(function (e) {
	$(".addCart").click(function (e) {
		e.preventDefault();
		const url = $(this).data("url");
		const roomId = $(this).data("room-id");
		const checkIn = $(this).data("check-in");
		const checkOut = $(this).data("check-out");

		if (!roomId || !checkIn || !checkOut) {
			alert("Data yang diperlukan tidak lengkap!");
			return;
		}

		$.ajax({
			url: `${url}cart/store`,
			type: "POST",
			data: {
				room_id: roomId,
				check_in: checkIn,
				check_out: checkOut,
			},
			success: function (res) {
				console.log(res);
				location.reload();
			},
			error: function (xhr, status, error) {
				console.log("Error:", error);
				console.log("Status:", status);
				console.log("XHR:", xhr);
				setTimeout(function () {
					location.reload();
				}, 2000);
			},
		});
	});

	$(".removeCart").click(function (e) {
		e.preventDefault();
		const url = $(this).data("url");
		const roomId = $(this).data("room-id");
		const userId = $(this).data("user-id");

		$.ajax({
			url: `${url}cart/user/${userId}/room/${roomId}/delete`,
			type: "DELETE",
			data: {
				userId,
				roomId,
			},
			success: function (res) {
				location.reload();
			},
			error: function (xhr, status, error) {
				console.log("Error:", error);
				console.log("Status:", status);
				console.log("XHR:", xhr);
				setTimeout(function () {
					location.reload();
				}, 2000);
			},
		});
	});
});
