$(document).ready(function () {
	$("#hotelDelete").click(function (e) {
		e.preventDefault();
		const url = $(this).data("url");
		const id = $(this).data("id");

		$.ajax({
			url: `${url}hotel/${id}/delete`,
			type: "DELETE",
			data: {
				id: id,
			},
			success: function (res) {
				$(`#hotel-${id}`).remove();
				$('[data-dismiss="modal"]').click();
			},
			error: function (xhr, status, error) {
				console.log(`delete error ${error}`);
				$('[data-dismiss="modal"]').click();
			},
		});
	});
});
