$(document).ready(function () {
	$("#bedDelete").click(function (e) {
		e.preventDefault();
		const url = $(this).data("url");
		const id = $(this).data("id");

		$.ajax({
			url: `${url}bed/${id}/delete`,
			type: "DELETE",
			data: {
				id,
			},
			success: function (res) {
				$(`#bed-${id}`).remove();
				$('[data-dismiss="modal"]').click();
				location.reload();
			},
			error: function (xhr, status, error) {
				console.log(`delete error ${error}`);
				setTimeout(function () {
					location.reload();
				}, 2000);
				$('[data-dismiss="modal"]').click();
			},
		});
	});
});
