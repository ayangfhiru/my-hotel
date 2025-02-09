$(document).ready(function () {
	$(".countdown-timer").each(function () {
		const expireTime = $(this).data("expire-time");
		const uploadImg = $(this).data("upload-img");
		const targetTime = new Date(expireTime).getTime();
		const timerId = $(this).attr("id");

		function formatTime(distance) {
			let days = Math.floor(distance / (1000 * 60 * 60 * 24));
			let hours = Math.floor(
				(distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
			);
			let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			let seconds = Math.floor((distance % (1000 * 60)) / 1000);

			return `${hours}h ${minutes}m ${seconds}s`;
		}

		let countdownInterval = setInterval(function () {
			const now = new Date().getTime();
			const distance = targetTime - now;

			$("#" + timerId).text(formatTime(distance));

			if (distance <= 0) {
				clearInterval(countdownInterval);
				$("#" + timerId).text("-");
			}
		}, 1000);
	});
});
