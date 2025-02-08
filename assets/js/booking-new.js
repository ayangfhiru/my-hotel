function toggleAccordion(index) {
	console.log("diklik");

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
	const part = index.split("-");
	const li = $(`#li-${index}`);
	const service = $(`#service-${index}`);
	const quantityInput = $(`#quantity-${index}`);
	const noteInput = $(`#note-${index}`);
	const price = parseInt(service.data("service-price"));
	const serviceName = service.data("service-name");

	if (service.prop("checked")) {
		quantityInput.prop("disabled", false).val(1);
		noteInput.prop("disabled", false);
		if (!$(`#detail-${index}`).length) {
			createElementService(serviceName, 1, price, index, li);
		}
	} else {
		quantityInput.prop("disabled", true).val(null);
		noteInput.prop("disabled", true).val(null);
		removeServiceDetails(index);
	}

	quantityInput.off("input").on("input", function () {
		const currentQuantity = parseInt($(this).val());
		const detailPrice = $(`#detail-${index} h1`);
		const elementTotal = $(`#detail-total-${part[0]} h1`);

		if (currentQuantity > 0) {
			const totalPrice = currentQuantity * price;
			detailPrice.text(number_format(totalPrice));
		}
	});
}

function createElementService(serviceName, quantity, price, index, li) {
	const room = index.split("-")[0];
	const totalPrice = quantity * price;

	const detailService = $("<li>", {
		id: `detail-${index}`,
		class: "flex justify-between items-center w-full border-b border-gray-400",
		html: `
            <h4 class="font-semibold text-sm">${serviceName}</h4>
            <h1 class="font-semibold text-lg">${number_format(totalPrice)}</h1>
        `,
	});

	$(`#detail-total-${room}`).before(detailService);

	$("<input>", {
		type: "hidden",
		id: `price-${index}`,
		name: `service_price[${room}][]`,
		value: price,
	}).appendTo(li);
}

function removeServiceDetails(index) {
	$(`#price-${index}, #detail-${index}`).remove();
}

function number_format(amount) {
	return amount.toLocaleString("id-ID");
}

let lastTab = null;

$(document).ready(function () {
	lastTab = $(".tabOpen")[0].id;
});

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

	const identical = $("#identical");
	if (identical.prop("checked")) {
		identical.prop("checked", false);
		getData(false);
	} else {
		getData(true);
		identical.prop("checked", true);
	}
}

function getData(disable) {
	const fullName = $("#tab-content [id*='full_name']");
	const email = $("#tab-content [id*='email']");
	const phoneNumber = $("#tab-content [id*='phone_number']");
	const identityType = $("#tab-content [id*='identity_type']");
	const identityNumber = $("#tab-content [id*='identity_number']");

	// Untuk fullName
	fullName.each(function (i) {
		if (i !== 0) {
			if (disable) {
				elementDisable($(this), true);
			} else {
				elementDisable($(this), false);
			}
		}
	});

	// Untuk email
	email.each(function (i) {
		if (i !== 0) {
			if (disable) {
				elementDisable($(this), true);
			} else {
				elementDisable($(this), false);
			}
		}
	});

	// Untuk phoneNumber
	phoneNumber.each(function (i) {
		if (i !== 0) {
			if (disable) {
				elementDisable($(this), true);
			} else {
				elementDisable($(this), false);
			}
		}
	});

	// Untuk identityType
	identityType.each(function (i) {
		if (i !== 0) {
			if (disable) {
				elementDisable($(this), true);
			} else {
				elementDisable($(this), false);
			}
		}
	});

	// Untuk identityNumber
	identityNumber.each(function (i) {
		if (i !== 0) {
			if (disable) {
				elementDisable($(this), true);
			} else {
				elementDisable($(this), false);
			}
		}
	});
}

function elementDisable(element, disable) {
	if (disable) {
		$(element).prop("disabled", true);
		$(element).removeClass("bg-white");
		$(element).addClass("bg-gray-300");
	} else {
		$(element).prop("disabled", false);
		$(element).removeClass("bg-gray-300");
		$(element).addClass("bg-white");
	}
}
