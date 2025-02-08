$(document).ready(function () {
	const checkbox = $('input[type="checkbox"][name="services[]"]');

	function number_format(amount) {
		return amount.toLocaleString("id-ID");
	}

	function updateAmount(serviceId = null) {
		let amount = $("#amount").data("amount");
		let total = 0;
		let totalAmount = 0;

		$('input[type="checkbox"][name="services[]"]:checked').each(function () {
			console.log("abc");

			serviceId = $(this).val();
			const quantity = $(`#quantity-${serviceId}`).val();
			const price = $(this).data("service-price");
			const service = $(`#service-price-${serviceId}`);

			if (quantity > 0) {
				total += price * quantity;
				service.val(price * quantity);
			}
		});

		totalAmount = amount + total;
		$("#amount").val(number_format(totalAmount));
	}

	checkbox.change(function () {
		const serviceId = $(this).val();
		console.log(serviceId);

		const quantityInput = $(`#quantity-${serviceId}`);
		const note = $(`#note-${serviceId}`);
		const service = $(`#service-price-${serviceId}`);
		const li = $(`#li-${serviceId}`);

		if ($(this).prop("checked")) {
			quantityInput.prop("disabled", false);
			quantityInput.val(1);
			note.prop("disabled", false);
			createElement(serviceId, li);
		} else {
			quantityInput.prop("disabled", true);
			quantityInput.val(0);
			note.prop("disabled", true);
			service.remove();
		}
		updateAmount(serviceId);
	});

	function createElement(id, parent) {
		$("<input>")
			.attr({
				id: `service-price-${id}`,
				type: "hidden",
				name: "service_price[]",
			})
			.appendTo(parent);
	}

	$('input[name="quantity[]"]').on("input", function () {
		updateAmount();
	});
});
