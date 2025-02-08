$(document).ready(function () {
	$("#roomDelete").click(function (e) {
		e.preventDefault();
		const url = $(this).data("url");
		const id = $(this).data("id");
		console.log(`${url}room/room/destroy/${id}`);

		$.ajax({
			url: `${url}room/room/destroy/${id}`,
			type: "DELETE",
			data: {
				id: id,
			},
			success: function (res) {
				$(`#room-${id}`).remove();
				$('[data-dismiss="modal"]').click();
				location.reload();
			},
			error: function (xhr, status, error) {
				console.log(`delete error ${status}`);
				setTimeout(function () {
					location.reload();
				}, 2000);
				$('[data-dismiss="modal"]').click();
			},
		});
	});
});
