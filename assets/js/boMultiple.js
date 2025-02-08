$(document).ready(function () {
	function numberFormat(amount) {
		return amount.toLocaleString("id-ID");
	}

	let lastTab = $(".tabOpen")[0] ? $(".tabOpen")[0].id : "";

	function openTab(dataTab) {
		const openButton = $(`#btn-${dataTab}`);

		if (lastTab !== null) {
			$(`#${lastTab}`).removeClass("grid");
			$(`#${lastTab}`).addClass("hidden");
			openButton.addClass("bg-blue-300");
		}
		$(`#${dataTab}`).addClass("grid");
		$(`#${dataTab}`).removeClass("hidden");
		openButton.removeClass("bg-blue-300");
		lastTab = dataTab;
	}

	function identicalData(event) {
		event.preventDefault();
		const isChecked = $("#identical");

		if (isChecked.prop("checked")) {
			isChecked.prop("checked", false);

			$("input[name^='full_name[']:not([name='full_name[0]'])").val("");
			$("input[name^='email[']:not([name='email[0]'])").val("");
			$("input[name^='phone_number[']:not([name='phone_number[0]'])").val("");
			$("select[name^='identity_type[']:not([name='identity_type[0]'])").val(
				""
			);
			$("input[name^='identity_number[']:not([name='identity_number[0]'])").val(
				""
			);
		} else {
			isChecked.prop("checked", true);

			const fullName = $("input[name='full_name[0]']").val();
			const email = $("input[name='email[0]']").val();
			const phoneNumber = $("input[name='phone_number[0]']").val();
			const identityType = $("select[name='identity_type[0]']").val();
			const identityNumber = $("input[name='identity_number[0]']").val();

			$("input[name^='full_name[']").val(fullName);
			$("input[name^='email[']").val(email);
			$("input[name^='phone_number[']").val(phoneNumber);
			$("select[name^='identity_type[']").val(identityType);
			$("input[name^='identity_number[']").val(identityNumber);
		}
	}

	function updateTotalPrice() {
		$("dd[id^='room-price-']").each(function () {
			const index = $(this).attr("id").split("-")[2];
			const roomPrice = $(this).data("room-price");
			$("#total-price-" + index).text("Rp " + roomPrice.toLocaleString());
		});
	}

	function toggleAccordion(event, index) {
		event.preventDefault();
		const content = $(`#content-${index}`);
		const icon = $(`#icon-${index}`);

		const minusSVG = `
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
        <path d="M3.75 7.25a.75.75 0 0 0 0 1.5h8.5a.75.75 0 0 0 0-1.5h-8.5Z" />
      </svg>`;

		const plusSVG = `
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
        <path d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
      </svg>`;

		if (
			content.css("max-height") !== "0px" &&
			content.css("max-height") !== "none"
		) {
			content.css("max-height", "0");
			icon.html(plusSVG);
		} else {
			content.css("max-height", content[0].scrollHeight + "px");
			icon.html(minusSVG);
		}
	}

	function toggleService(index) {
		const li = $(`#li-${index}`);
		const service = $(`#service-${index}`);
		const viewQuantity = $(`#view-quantity-${index}`);
		const noteInput = $(`#note-${index}`);
		const servicePrice = parseInt(service.data("service-price"));
		const serviceName = service.data("service-name");

		if (service.prop("checked")) {
			viewQuantity.prop("disabled", false).text(1);
			noteInput.prop("disabled", false);
			createElementServicePrice(index, li, servicePrice, serviceName);
		} else {
			viewQuantity.prop("disabled", true).text(0);
			noteInput.prop("disabled", true).val(null);
			removeElementServicePrice(index);
		}
	}

	function createElementServicePrice(index, position, price, name) {
		const part = index.split("-");
		const key = part[0];
		$("<input>")
			.attr({
				id: `service-price-${index}`,
				type: "hidden",
				name: `service_price[${key}][]`,
				value: price,
			})
			.appendTo(position);

		$("<input>")
			.attr({
				id: `service-quantity-${index}`,
				type: "hidden",
				name: `service_quantity[${key}][]`,
				value: 1,
			})
			.appendTo(position);

		$("<input>")
			.attr({
				id: `service-name-${index}`,
				type: "hidden",
				name: `service_name[${key}][]`,
				value: name,
			})
			.appendTo(position);
	}

	function removeElementServicePrice(index) {
		$(`#service-price-${index}`).remove();
		$(`#service-quantity-${index}`).remove();
		$(`#service-name-${index}`).remove();
	}

	$("input[name^='quantity[']").on("input", function () {
		var quantityInput = $(this);
		console.log(quantityInput);

		var decrementButton = quantityInput
			.closest("li")
			.find("button#decrement-button");
		var value = parseInt(quantityInput.val());

		// Validasi agar tidak ada nilai lebih kecil dari 1
		if (value <= 1) {
			decrementButton.prop("disabled", true); // Disable decrement jika nilai <= 1
		} else {
			decrementButton.prop("disabled", false); // Enable decrement jika nilai > 1
		}
	});

	// Menangani saat tombol increment atau decrement diklik
	$("button#increment-button").on("click", function (e) {
		const index = $(this).data("increment");
		const viewQuantity = $(`#view-quantity-${index}`);
		let valViewQuantity = parseInt(viewQuantity.text()) + 1;
		viewQuantity.text(valViewQuantity); // Update tampilan quantity

		// Update quantity input hidden
		const quantityInput = $(`#service-quantity-${index}`);
		quantityInput.val(valViewQuantity); // Update value hidden input
	});

	$("button#decrement-button").on("click", function () {
		const index = $(this).data("decrement");
		const quantityInput = $(`#service-quantity-${index}`);
		let newValue = parseInt(quantityInput.val()) - 1;

		// Pastikan nilai tidak lebih kecil dari 1
		if (newValue >= 1) {
			quantityInput.val(newValue); // Update value hidden input
			$(`#view-quantity-${index}`).text(newValue); // Update tampilan view quantity
		}
	});

	$(document).on(
		"change",
		'.btnExtraService input[type="checkbox"]',
		function () {
			const index = $(this).attr("id").split("-").slice(1).join("-");
			toggleService(index);
		}
	);

	updateTotalPrice();
});
