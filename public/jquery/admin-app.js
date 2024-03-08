$(document).ready(function () {
	/* DECLARYTION VARIABLES */
	const galleyTitle = $(".gallery-title-ajx");
	const restoreAll = $("#restore-all");
	const restoreItem = $("#restore-item");
	const deleteAll = $("#delete-all");
	const deleteRowItem = $("#delete-item");
	const deletePhoto = $("#delete-photo");
	const deletePhoto2 = $("#delete-photo2");
	const deletePhoto3 = $("#delete-photo3");
	const deletePhoto4 = $("#delete-photo4");
	const regularPrice = $(".regular_price");
	const salePrice = $(".sale_price");
	const discount = $(".discount");
	const photoZoneElement = $("#photo-zone");
	const photoZoneElement2 = $("#photo-zone2");
	const photoZoneElement3 = $("#photo-zone3");
	const photoZoneElement4 = $("#photo-zone4");
	const filterCategory = $(".filter-category");
	const checkAll = $(".checkall");
	const checkItems = $(".checkitem");
	const filterCategoryRendering = $(".filter-category-rendering");
	const buildSEO = $(".build-seo");
	const keyword = $(".keyword");
	const myfirstchart = $("#myfirstchart");
	const selectDateChart = $("#select-date-chart");
	const btnAddOption = $(".btn-add-option");
	const formatPrice = $(".format-price");

	/* Thêm thuộc tính */
	if (btnAddOption) {
		btnAddOption.click(function () {
			const idProduct = $(this).data("id");
			$.ajax({
				url: `${BASE_URL}admin/product/option/load_data`,
				type: "GET",
				success: function (result) {
					$("#load_data_options").append(result);

					if ($(".btn-save-option").length) {
						$(".inputs-main").each(function () {
							let inputsMain = $(this);
							let formOptProduct = inputsMain.find(".form-opt-product");
							inputsMain.find(".btn-save-option").click(function () {
								formOptProduct.attr(
									"action",
									`${BASE_URL}admin/product/option_stored?id=${idProduct}`
								);
								formOptProduct.submit();
							});
						});
					}

					/* Xử lý format money */
					if ($(".format-price-opt").length) {
						$(".inputs-main").each(function () {
							var inputs = $(this);
							inputs.find(".format-price-opt").priceFormat({
								limit: 13,
								prefix: "",
								centsLimit: 0,
							});
						});
					}

					/* Xử lý chiết khấu */
					if ($(".sale_price_opt").length && $(".regular_price_opt").length) {
						$(".sale_price_opt, .regular_price_opt").on("keyup", function () {
							$(".inputs-main").each(function () {
								let inputContainer = $(this);
								let salePriceOpt = parseFloat(
									inputContainer.find(".sale_price_opt").val().replace(/,/g, "")
								);
								let regularPriceOpt = parseFloat(
									inputContainer
										.find(".regular_price_opt")
										.val()
										.replace(/,/g, "")
								);
								if (!isNaN(salePriceOpt) && !isNaN(regularPriceOpt)) {
									if (salePriceOpt < regularPriceOpt) {
										let discountOpt =
											((regularPriceOpt - salePriceOpt) / regularPriceOpt) *
											100;
										inputContainer
											.find(".discount_opt")
											.val(Math.ceil(discountOpt.toFixed(2)));
									} else {
										inputContainer.find(".discount_opt").val(0);
									}
								} else {
									inputContainer.find(".discount_opt").val(0);
								}
							});
						});
					}
				},
			});
		});
	}

	if ($(".format-price-render").length) {
		$(".inputs-render").each(function () {
			var inputs = $(this);
			inputs.find(".format-price-render").priceFormat({
				limit: 13,
				prefix: "",
				centsLimit: 0,
			});
		});
	}

	if ($(".sale_price_render").length && $(".regular_price_render").length) {
		$(".sale_price_render, .regular_price_render").on("keyup", function () {
			$(".inputs-render").each(function () {
				let inputContainer = $(this);
				let salePriceOpt = parseFloat(
					inputContainer.find(".sale_price_render").val().replace(/,/g, "")
				);
				let regularPriceOpt = parseFloat(
					inputContainer.find(".regular_price_render").val().replace(/,/g, "")
				);
				if (!isNaN(salePriceOpt) && !isNaN(regularPriceOpt)) {
					if (salePriceOpt < regularPriceOpt) {
						let discountOpt =
							((regularPriceOpt - salePriceOpt) / regularPriceOpt) * 100;
						inputContainer
							.find(".discount_render")
							.val(Math.ceil(discountOpt.toFixed(2)));
					} else {
						inputContainer.find(".discount_render").val(0);
					}
				} else {
					inputContainer.find(".discount_render").val(0);
				}
			});
		});
	}

	if (buildSEO) {
		buildSEO.click(function () {
			const titleText = $(this)
				.parents(".content")
				.find(".card-body.card-article #title")
				.val();
			const descText = $(this)
				.parents(".content")
				.find(".card-body.card-article #desc")
				.val();
			const titleSeo = $(this)
				.parents(".card-header")
				.next()
				.children()
				.find("#title_seo");
			const keywordSeo = $(this)
				.parents(".card-header")
				.next()
				.children()
				.find("#keywords_seo");
			const descSeo = $(this)
				.parents(".card-header")
				.next()
				.children()
				.find("#description_seo");
			if (titleText) {
				titleSeo.val(titleText);
				keywordSeo.val(titleText);
			} else {
				titleSeo.val("");
				keywordSeo.val("");
			}
			descText ? descSeo.val(htmlToText(descText)) : "";
		});
	}

	/* Filter Category With Page */
	filterCategoryRendering.change(function () {
		const URL = $(this).data("url");
		const url = `${BASE_URL}${URL}`;
		onchangeCategory(".filter-category-rendering", url);
	});

	/* Handle search page product */
	keyword.change(function () {
		const URL = $(this).data("url");
		const url = `${BASE_URL}${URL}`;
		onchangeCategory("", url, ".keyword");
	});

	keyword.keypress(function (event) {
		if (event.keyCode == 13 || event.which == 13) {
			return false;
		}
	});

	/* Handle Checked Table */
	if (checkAll && checkItems) {
		checkAll.change(function () {
			$(this).prop("checked") === true
				? checkItems.prop("checked", true)
				: checkItems.prop("checked", false);
		});
		checkItems.change(function () {
			const itemIsChecked = $('input[name="checkitem[]"]:checked');
			itemIsChecked.length && checkItems.length === itemIsChecked.length
				? checkAll.prop("checked", true)
				: checkAll.prop("checked", false);
		});
	}

	/* Handle load ajax category */
	if (filterCategory) {
		filterCategory.change(function () {
			let action = $(this).attr("id");
			let id = $(this).val();
			let result = "";
			const URL = $(this).data("url");
			if (action == "id_parent1") result = "id_parent2";
			$.ajax({
				url: `${BASE_URL}${URL}`,
				data: {
					action: action,
					id: id,
					_token: $("input[name='_token_filter_category']").val(),
				},
				method: "POST",
				success: function (respone) {
					$("#" + result).html(respone);
					return false;
				},
				error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.status);
					alert(thrownError);
				},
			});
		});
	}

	/* PhotoZone 1 */
	if (photoZoneElement.length)
		photoZone("#photo-zone", "#file-zone", "#photoUpload-preview img");

	/* PhotoZone 2 */
	if (photoZoneElement2.length)
		photoZone("#photo-zone2", "#file-zone2", "#photoUpload-preview2 img");

	/* PhotoZone 3 */
	if (photoZoneElement3.length)
		photoZone("#photo-zone3", "#file-zone3", "#photoUpload-preview3 img");

	/* PhotoZone 4 */
	if (photoZoneElement4.length)
		photoZone("#photo-zone4", "#file-zone4", "#photoUpload-preview4 img");

	/* Rounde number */
	function roundNumber(roundNumber, roundLength) {
		return (
			Math.round(roundNumber * Math.pow(10, roundLength)) /
			Math.pow(10, roundLength)
		);
	}

	/* Format price */
	if (formatPrice.length) {
		formatPrice.priceFormat({
			limit: 13,
			prefix: "",
			centsLimit: 0,
		});
	}

	/* Handle Convert Product Price */
	if (regularPrice.length && salePrice.length) {
		salePrice.keyup(function () {
			regularPrice.prop("disabled", false);
			let price3 = $(this).val();
			let price2 = price3.replace(",", "");
			let price1 = price2.replace(",", "");
			let price = price1.replace(",", "");
			$(this).attr("value", price);
		});
		salePrice.blur(function () {
			let key = salePrice.attr("value");
			if (key > 0) {
				regularPrice.prop("disabled", false);
			} else {
				regularPrice.val(0);
				regularPrice.prop("disabled", true);
			}
		});
		$(".regular_price, .sale_price").keyup(function () {
			let regularPriceValue = regularPrice.val();
			let salePriceValue = salePrice.length ? salePrice.val() : 0;
			let discountNumber = 0;

			if (
				regularPriceValue == "" ||
				regularPriceValue == "0" ||
				salePriceValue == "" ||
				salePriceValue == "0"
			) {
				discountNumber = 0;
			} else {
				regularPriceValue = regularPriceValue.replace(/,/g, "");
				salePriceValue = salePriceValue ? salePriceValue.replace(/,/g, "") : 0;
				regularPriceValue = parseInt(regularPriceValue);
				salePriceValue = parseInt(salePriceValue);

				if (salePriceValue < regularPriceValue) {
					discountNumber = 100 - (salePriceValue * 100) / regularPriceValue;
					discountNumber = roundNumber(discountNumber, 0);
				} else {
					if (discount.length) discountNumber = 0;
				}
			}
			if (discount.length) discount.val(discountNumber);
		});
	}

	/* Handle Delete One Row */
	if (deleteRowItem.length) {
		$("body").on("click", "#delete-item", function () {
			const url = $(this).data("url");
			confirmDialog("delete-item", "Bạn có chắc muốn xóa mục này ?", url);
		});
	}

	/* Handle Delete Photo 1 */
	if (deletePhoto.length) {
		$("body").on("click", "#delete-photo", function () {
			const url = $(this).data("url");
			confirmDialog("delete-photo", "Bạn có chắc muốn xóa ảnh này ?", url);
		});
	}

	/* Handle Delete Photo 2 */
	if (deletePhoto2.length) {
		$("body").on("click", "#delete-photo2", function () {
			const url = $(this).data("url");
			confirmDialog("delete-photo2", "Bạn có chắc muốn xóa ảnh này ?", url);
		});
	}

	/* Handle Delete Photo 3 */
	if (deletePhoto3.length) {
		$("body").on("click", "#delete-photo3", function () {
			const url = $(this).data("url");
			confirmDialog("delete-photo3", "Bạn có chắc muốn xóa ảnh này ?", url);
		});
	}

	/* Handle Delete Photo 4 */
	if (deletePhoto4.length) {
		$("body").on("click", "#delete-photo4", function () {
			const url = $(this).data("url");
			confirmDialog("delete-photo4", "Bạn có chắc muốn xóa ảnh này ?", url);
		});
	}

	/* Handle Restore One Row */
	if (restoreItem.length) {
		$("body").on("click", "#restore-item", function () {
			const url = $(this).data("url");
			confirmDialog(
				"restore-item",
				"Bạn có chắc muốn khôi phục mục này ?",
				url
			);
		});
	}

	/* Handle Delete All Data */
	if (deleteAll.length) {
		$("body").on("click", "#delete-all", function () {
			let url = $(this).data("url");
			const itemIsChecked = $('input[name="checkitem[]"]:checked');
			if (itemIsChecked) {
				if (itemIsChecked.length === 0) {
					notifyDialog("Bạn hãy chọn ít nhất 1 mục để xóa");
					return false;
				} else {
					confirmDialog("delete-all", "Bạn có chắc muốn xóa mục này ?", url);
				}
			}
		});
	}

	/* Handle Restore All Data */
	if (restoreAll.length) {
		$("body").on("click", "#restore-all", function () {
			let url = $(this).data("url");
			const itemIsChecked = $('input[name="checkitem[]"]:checked');
			if (itemIsChecked) {
				if (itemIsChecked.length === 0) {
					notifyDialog("Bạn hãy chọn ít nhất 1 mục để khôi phục");
					return false;
				} else {
					confirmDialog(
						"restore-all",
						"Bạn có chắc muốn khôi phục mục này ?",
						url
					);
				}
			}
		});
	}

	/* Handle gallery dropzone image */
	Dropzone.options.dropzoneFrom = {
		autoProcessQueue: true,
		acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg,.webp",
		init: function () {
			this.on("complete", function () {
				if (
					this.getQueuedFiles().length == 0 &&
					this.getUploadingFiles().length == 0
				) {
					let _this = this;
					_this.removeAllFiles();
				}
			});
			// $("#dropzoneFrom").submit();
		},
	};

	/* Handle Remove Gallery Item */
	$(document).on("click", ".remove_image", function () {
		const name = $(this).attr("id");
		const URL = $(this).data("url");
		$.ajax({
			url: `${BASE_URL}${URL}`,
			method: "POST",
			data: {
				name: name,
			},
			success: function (data) {
				renderGalleryList();
			},
		});
	});

	/* Handle Update Title Gallery Image */
	if (galleyTitle.length) {
		galleyTitle.change(function () {
			const URL = $(this).data("url");
			const id = $(this).data("id");
			const idParent = $(this).data("idparent");
			const value = $(this).val();
			const table = $(this).data("table");
			const status = $(this).data("status");
			const hash = $(this).data("hash");
			const data = {
				status: status,
				hash: hash,
				id: id,
				id_parent: idParent,
				value: value,
				table: table,
				_token: $("input[name='_token_gallery_title']").val(),
			};
			$.ajax({
				url: `${BASE_URL}${URL}`,
				method: "POST",
				data: data,
				dataType: "text",
				success: function (respone) {
					return false;
				},
				error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.status);
					alert(thrownError);
				},
			});
		});
	}

	/* CALLBACK FUNCTION */
	ajaxStatus(".check-sst-product", `${BASE_URL}admin/product/ajax_status`);
	ajaxStatus(
		".check-sst-product1",
		`${BASE_URL}admin/category_product1/ajax_status`
	);
	ajaxStatus(
		".check-sst-product2",
		`${BASE_URL}admin/category_product2/ajax_status`
	);
	ajaxStatus(
		".check-sst-product3",
		`${BASE_URL}admin/category_product3/ajax_status`
	);
	ajaxStatus(
		".check-sst-product4",
		`${BASE_URL}admin/category_product4/ajax_status`
	);
	ajaxStatus(".check-sst-photo", `${BASE_URL}admin/photo/ajax_status`);
	ajaxStatus(".check-sst-news", `${BASE_URL}admin/news/ajax_status`);
	ajaxStatus(".check-sst-policy", `${BASE_URL}admin/policy/ajax_status`);
	ajaxStatus(
		".check-sst-newsletter",
		`${BASE_URL}admin/newsletter/ajax_status`
	);
	ajaxStatus(".check-sst-news1", `${BASE_URL}admin/category_news1/ajax_status`);
	ajaxStatus(".check-sst-news2", `${BASE_URL}admin/category_news2/ajax_status`);
	ajaxStatus(".check-sst-news3", `${BASE_URL}admin/category_news3/ajax_status`);
	ajaxStatus(".check-sst-news4", `${BASE_URL}admin/category_news4/ajax_status`);

	ajaxUpdateNum(".update-num-photo", `${BASE_URL}admin/photo/ajax_num`);
	ajaxUpdateNum(".update-num-product", `${BASE_URL}admin/product/ajax_num`);
	ajaxUpdateNum(
		".update-num-product-size",
		`${BASE_URL}admin/product/size/ajax_num`
	);
	ajaxUpdateNum(
		".update-num-product-color",
		`${BASE_URL}admin/product/color/ajax_num`
	);
	ajaxUpdateNum(".update-num-news", `${BASE_URL}admin/news/ajax_num`);
	ajaxUpdateNum(".update-num-policy", `${BASE_URL}admin/policy/ajax_num`);
	ajaxUpdateNum(
		".update-num-newsletter",
		`${BASE_URL}admin/newsletter/ajax_num`
	);
	ajaxUpdateNum(".update-num-order", `${BASE_URL}admin/order/ajax_num`);
	ajaxUpdateNum(
		".update-num-order-detail",
		`${BASE_URL}admin/order_detail/ajax_num`
	);
	ajaxUpdateNum(".update-num-gallery", `${BASE_URL}admin/product/ajax_num`);
	ajaxUpdateNum(".update-num-gallery-news", `${BASE_URL}admin/news/ajax_num`);
	ajaxUpdateNum(
		".update-num-cat-product1",
		`${BASE_URL}admin/category_product1/ajax_num`
	);
	ajaxUpdateNum(
		".update-num-cat-product2",
		`${BASE_URL}admin/category_product2/ajax_num`
	);
	ajaxUpdateNum(
		".update-num-cat-product3",
		`${BASE_URL}admin/category_product3/ajax_num`
	);
	ajaxUpdateNum(
		".update-num-cat-product4",
		`${BASE_URL}admin/category_product4/ajax_num`
	);
	ajaxUpdateNum(
		".update-num-cat-news1",
		`${BASE_URL}admin/category_news1/ajax_num`
	);
	ajaxUpdateNum(
		".update-num-cat-news2",
		`${BASE_URL}admin/category_news2/ajax_num`
	);
	ajaxUpdateNum(
		".update-num-cat-news3",
		`${BASE_URL}admin/category_news3/ajax_num`
	);
	ajaxUpdateNum(
		".update-num-cat-news4",
		`${BASE_URL}admin/category_news4/ajax_num`
	);
	generateSlug();
	forSeo();

	if (myfirstchart) {
		Chart();
		var char = new Morris.Line({
			element: "myfirstchart",
			xkey: "order_date",
			ykeys: ["order_date", "order", "order_sales", "order_buy_qty"],
			labels: ["Ngày đặt", "Đơn hàng", "Doanh thu bán", "Số lượng đã bán"],
		});
	}
	/* Chart */
	function Chart() {
		var text = "365 ngày qua";
		$.ajax({
			method: "POST",
			url: `${BASE_URL}admin/dashboard/chart`,
			dataType: "JSON",
			success: function (data) {
				char.setData(data);
				$("#text-date").text(text);
			},
		});
	}
	if (selectDateChart) {
		selectDateChart.change(function () {
			let date = $(this).val();
			let text;
			switch (date) {
				case "7ngayqua":
					text = "7 ngày qua";
					break;
				case "14ngayqua":
					text = "14 ngày qua";
					break;
				case "28ngayqua":
					text = "28 ngày qua";
					break;
				case "365ngayqua":
					text = "365 ngày qua";
					break;
				default:
					break;
			}

			$.ajax({
				method: "POST",
				url: `${BASE_URL}admin/dashboard/chart`,
				data: { date: date },
				dataType: "JSON",
				success: function (data) {
					char.setData(data);
					$("#text-date").text(text);
				},
			});
		});
	}
});
