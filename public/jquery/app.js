$(document).ready(function () {
	/* Variables */
	const qty = $(".qty");
	const eye1 = $(".eye1");
	const eye2 = $(".eye2");
	let btn = $("#button_back_to_top");

	// Add to cart
	if ($(".cart-buy")) {
		$(".cart-buy").click(function (e) {
			e.preventDefault();
			const id = $(this).data("id");
			$.ajax({
				url: `${baseUrl}cart/add`,
				method: "GET",
				data: { id: id },
				success: function (res) {
					window.location.href = `${baseUrl}cart`;
					return false;
				},
				error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.status);
					alert(thrownError);
				},
			});
		});
	}

	// Back to top
	$(window).scroll(function () {
		if ($(window).scrollTop() > 300) {
			btn.addClass("show");
		} else {
			btn.removeClass("show");
		}
	});

	// Scroll menu
	$(window).scroll(function () {
		var scrollTop = $(window).scrollTop();
		var heightHeader = $(".nav-mn").height() + 50;

		if (scrollTop > heightHeader) {
			if (!$(".nav-mn").hasClass("fix_mn")) {
				$(".nav-mn").addClass("fix_mn");
			}
		} else {
			$(".nav-mn").removeClass("fix_mn");
		}
	});

	btn.on("click", function (e) {
		e.preventDefault();
		$("html, body").animate({ scrollTop: 0 }, "300");
	});

	doEye(eye1);
	doEye(eye2);

	/* Change size */
	if ($(".size-box")) {
		$(".size-box").change(function () {
			const salePrice = $(this).find("option:selected").data("sprice");
			const regularPrice = $(this).find("option:selected").data("rprice");
			const idSize = $(this).find("option:selected").data("ids");
			const id = $(this).val();
			const nameSize = $(this).find("option:selected").data("size");
			$(this)
				.parents(".product-opt")
				.prev()
				.find(".price-new")
				.text(salePrice)
				.priceFormat({
					limit: 13,
					prefix: "",
					centsLimit: 0,
					suffix: "đ",
				});
			$(this)
				.parents(".product-opt")
				.prev()
				.find(".price-odd")
				.text(regularPrice)
				.priceFormat({
					limit: 13,
					prefix: "",
					centsLimit: 0,
					suffix: "đ",
				});

			$.ajax({
				url: `${baseUrl}cart/add`,
				method: "GET",
				data: {
					id: id,
					sale_price: salePrice,
					regular_price: regularPrice,
					id_size: idSize,
					name_size: nameSize,
				},
				success: function (res) {
					window.location.href = `${baseUrl}cart`;
					return false;
				},
				error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.status);
					alert(thrownError);
				},
			});
		});
	}
	if ($(".color-box")) {
		$(".color-box").change(function () {
			const salePrice = $(this).find("option:selected").data("sprice");
			const regularPrice = $(this).find("option:selected").data("rprice");
			const photoColor = $(this).find("option:selected").data("photo");
			const idColor = $(this).find("option:selected").data("idc");
			const nameColor = $(this).find("option:selected").data("color");
			const id = $(this).val();
			$(this)
				.parents(".product-opt")
				.prev()
				.find(".price-new")
				.text(salePrice)
				.priceFormat({
					limit: 13,
					prefix: "",
					centsLimit: 0,
					suffix: "đ",
				});
			$(this)
				.parents(".product-opt")
				.prev()
				.find(".price-odd")
				.text(regularPrice)
				.priceFormat({
					limit: 13,
					prefix: "",
					centsLimit: 0,
					suffix: "đ",
				});
			$(this)
				.parents(".product-detail-right")
				.prev()
				.find("picture img")
				.attr("src", `${baseUrl}${photoColor}`);

			$.ajax({
				url: `${baseUrl}cart/add`,
				method: "GET",
				data: {
					id: id,
					sale_price: salePrice,
					regular_price: regularPrice,
					id_color: idColor,
					name_color: nameColor,
				},
				success: function (res) {
					window.location.href = `${baseUrl}cart`;
					return false;
				},
				error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.status);
					alert(thrownError);
				},
			});
		});
	}

	if ($(".partner")) {
		/* SLICK */
		$(".partner").slick({
			slidesToShow: 6,
			speed: 300,
			autoplay: true,
			arrows: false,
			dots: false,
			autoplaySpeed: 2000,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 1025,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 4,
						infinite: true,
						dots: false,
					},
					breakpoint: 480,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3,
						infinite: true,
						dots: false,
					},
				},
			],
		});
	}
	if ($(".slideshow")) {
		/* SLICK */
		$(".slideshow").slick({
			slidesToShow: 1,
			speed: 300,
			autoplay: true,
			arrows: false,
			dots: false,
			autoplaySpeed: 2000,
			slidesToScroll: 1,
			// responsive: [],
		});
	}
	if ($(".product-slick-slide")) {
		/* SLICK */
		$(".product-slick-slide").slick({
			slidesToShow: 4,
			speed: 300,
			autoplay: true,
			arrows: false,
			dots: false,
			autoplaySpeed: 2000,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 1025,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3,
						infinite: true,
						dots: false,
					},
					breakpoint: 480,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2,
						infinite: true,
						dots: false,
					},
				},
			],
		});
	}
	if ($(".product-slick-slide-hot")) {
		/* SLICK */
		$(".product-slick-slide-hot").slick({
			slidesToShow: 4,
			speed: 300,
			autoplay: true,
			arrows: false,
			dots: false,
			autoplaySpeed: 2000,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 1025,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 4,
						infinite: true,
						dots: false,
					},
					breakpoint: 578,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3,
						infinite: true,
						dots: false,
					},
					breakpoint: 481,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2,
						infinite: true,
						dots: false,
					},
				},
			],
		});
	}
	if ($(".slideshow-gallery")) {
		/* SLICK */
		$(".slideshow-gallery").slick({
			slidesToShow: 7,
			speed: 300,
			autoplay: true,
			arrows: false,
			dots: false,
			autoplaySpeed: 2000,
			slidesToScroll: 1,
			// responsive: [],
		});
	}
	if ($(".news-slick-slide")) {
		/* SLICK */
		$(".news-slick-slide").slick({
			slidesToShow: 4,
			speed: 300,
			autoplay: true,
			arrows: false,
			dots: false,
			autoplaySpeed: 2000,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 1025,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3,
						infinite: true,
						dots: false,
					},
					breakpoint: 480,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2,
						infinite: true,
						dots: false,
					},
				},
			],
		});
	}

	if (qty) {
		qty.change(function () {
			const value = $(this).val();
			const URL = $(this).data("url");
			const id = $(this).data("id");
			const price = $(this).data("price");
			const direct = `${baseUrl}${URL}?id=${id}&qty=${value}&price=${price}`;
			const data = { id: id, qty: value, price: price };
			$.ajax({
				url: direct,
				method: "GET",
				data: data,
				dataType: "JSON",
				success: function (res) {
					$(".cart_total_price").text(res.total);
					$(".cart_sub_price_" + id).text(res.sub_total);
					return false;
				},
				error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.status);
					alert(thrownError);
				},
			});
		});
	}

	// Nav menu res
	if ($(".navbar-toggler")) {
		$(".navbar-toggler").click(function () {
			$(this).next().stop().slideToggle();
		});
	}
});
