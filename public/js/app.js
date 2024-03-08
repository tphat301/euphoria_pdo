window.addEventListener("DOMContentLoaded", function () {
	const slide = document.querySelectorAll(".slide-img");
	const imgMain = document.querySelector(".img-main");
	[...slide].forEach((item) =>
		item.addEventListener("mouseenter", function (e) {
			imgMain.setAttribute("src", e.currentTarget.dataset.src);
		})
	);
});
