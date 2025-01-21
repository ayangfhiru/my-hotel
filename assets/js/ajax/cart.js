$(document).ready(function (e) {
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
				$(`#cart-${roomId}`).remove();
			},
			error: function (xhr, status, error) {
				console.log(error);
			},
		});
	});
});
