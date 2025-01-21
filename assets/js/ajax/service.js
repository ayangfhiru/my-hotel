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
			},
			error: function (xhr, status, error) {
				console.log(`delete error ${error}`);
				$('[data-dismiss="modal"]').click();
			},
		});
	});
});
