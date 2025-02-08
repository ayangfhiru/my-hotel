$(document).ready(function () {
	function deleteItem(button, url, removeSelector) {
		button.click(function (e) {
			e.preventDefault();
			const id = button.data("id");
			const requestUrl = url.replace("ID", id);

			$.ajax({
				url: requestUrl,
				type: "DELETE",
				data: {
					id,
				},
				success: function (res) {
					$(`${removeSelector}${id}`).remove();
					$('[data-dismiss="modal"]').click();
					location.reload();
				},
				error: function (xhr, status, error) {
					console.log(`Delete error: ${error}`);
					setTimeout(function () {
						location.reload();
					}, 2000);
					$('[data-dismiss="modal"]').click();
				},
			});
		});
	}

	// fungsi Hotel
	deleteItem(
		$("#hotelDelete"),
		$("#hotelDelete").data("url") + "hotel/ID/delete",
		"#hotel-"
	);

	// fungsi Bed
	deleteItem(
		$("#bedDelete"),
		$(this).data("url"),
		"#bed-" + $("#bedDelete").data("id")
	);

	// fungsi Cart
	// deleteItem(
	// 	$(".removeCart"),
	// 	$(this).data("url"),
	// 	"#list-cart-" + $(".removeCart").data("room-id")
	// );

	// fungsi Facilities
	deleteItem(
		$("#facilityDelete"),
		$("#facilityDelete").data("url") +
			"facility/destroy/" +
			$("#facilityDelete").data("id"),
		$(this).data("url"),
		"#facility-"
	);

	// fungsi Manage Booking Status
	deleteItem(
		$(".manageBtn"),
		$(this).data("url"),
		"#hotel-" + $("#hotelDelete").data("id")
	);

	// fungsi Room Code
	deleteItem(
		$("#roomCodeDelete"),
		$(this).data("url"),
		"#room-code-" + $("#hotelDelete").data("id")
	);

	// fungsi Room
	deleteItem(
		$("#roomDelete"),
		$(this).data("url"),
		"#room-" + $("#hotelDelete").data("id")
	);

	// fungsi Service
	deleteItem(
		$("#serviceDelete"),
		$(this).data("url"),
		"#service-" + $("#hotelDelete").data("id")
	);
});
