$(document).ready(function () {
	$("#bedDelete").click(function (e) {
		e.preventDefault();
		const url = $(this).data("url");
		const id = $(this).data("id");

		$.ajax({
			url: `${url}bed/destroy/${id}`,
			type: "DELETE",
			data: {
				id,
			},
			success: function (res) {
				$(`#bed-${id}`).remove();
				$('[data-dismiss="modal"]').click();
			},
			error: function (xhr, status, error) {
				console.log(`delete error ${error}`);
				$('[data-dismiss="modal"]').click();
			},
		});
	});
});
