/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		"./application/views/**/*.php", // Semua file view di folder views
		"./application/views/**/*.html", // Jika menggunakan file HTML
	],
	theme: {
		extend: {},
	},
	plugins: [],
};
