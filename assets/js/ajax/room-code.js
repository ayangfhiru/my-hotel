$(document).ready(function () {
	$("#roomCodeId").click(function (e) {
		e.preventDefault();
		const url = $(this).data("url");
		const id = $(this).data("id");

		$.ajax({
			url: `${url}room-code/destroy/${id}`,
			type: "DELETE",
			data: {
				id: id,
			},
			success: function (res) {
				$(`#room-code-${id}`).remove();
				$('[data-dismiss="modal"]').click();
			},
			error: function (xhr, status, error) {
				console.log(`delete error ${error}`);
				$('[data-dismiss="modal"]').click();
			},
		});
	});
});
