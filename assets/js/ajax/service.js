$(document).ready(function () {
	$("#serviceDelete").click(function (e) {
		e.preventDefault();
		const url = $(this).data("url");
		const id = $(this).data("id");

		$.ajax({
			url: `${url}service/destroy/${id}`,
			type: "DELETE",
			data: {
				id: id,
			},
			success: function (res) {
				$(`#service-${id}`).remove();
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
