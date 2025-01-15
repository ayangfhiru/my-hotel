$(document).ready(function () {
	function number_format(amount) {
		return amount.toLocaleString("id-ID");
	}

	function updateAmount(
		serviceId = null,
		quantityInput = null,
		isChecked = null
	) {
		let amount = $("#amount").data("amount");
		let total = 0;
		let totalAmount = 0;

		$('input[type="checkbox"][name="services[]"]:checked').each(function () {
			const serviceId = $(this).val();
			const quantity = $("#quantity-" + serviceId).val();
			const price = parseInt($("#service-price-" + serviceId).val());

			if (quantity > 0) {
				total += price * quantity;
			}
		});

		if (isChecked) {
			totalAmount = amount + total;
		} else {
			totalAmount = amount + total;
		}
		$("#amount").val(number_format(totalAmount));
	}

	$('input[type="checkbox"][name="services[]"]').change(function () {
		const serviceId = $(this).val();
		const quantityInput = $("#quantity-" + serviceId);

		if ($(this).prop("checked")) {
			quantityInput.prop("disabled", false);
			quantityInput.val(1);
		} else {
			quantityInput.prop("disabled", true);
			quantityInput.val(0);
		}
		updateAmount(serviceId, quantityInput, $(this).prop("checked"));
	});

	$('input[name="quantity[]"]').on("input", function () {
		updateAmount();
	});
});
