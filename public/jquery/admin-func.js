/* Covert html to text */
function htmlToText(value) {
	const text = value
		.replace(/<style([\s\S]*?)<\/style>/gi, " ")
		.replace(/<script([\s\S]*?)<\/script>/gi, " ")
		.replace(/(<(?:.|\n)*?>)/gm, " ")
		.replace(/\s+/gm, " ");
	return text;
}

/* Filter Category */
function filterCategory(elements = "", url) {
	if ($(elements).length > 0 && url != "") {
		let id = "";
		let value = "";

		$(elements).each(function (index) {
			id = $(this).attr("id");
			if (id) {
				value = parseInt($("#" + id).val());
				if (value) {
					const parameterValue = value;
					const parameterName = $("#" + id).attr("name");
					let strParameter = "";
					switch (parameterName) {
						case "id_parent1":
							strParameter += "?";
							url += strParameter + parameterName + "=" + parameterValue;
							break;
						case "id_parent2":
							strParameter += "&";
							url +=
								"?id_parent1=" +
								strParameter +
								parameterName +
								"=" +
								parameterValue;
							break;
						case "id_parent3":
							strParameter += "&";
							url +=
								"?id_parent1=" +
								"&id_parent2=" +
								strParameter +
								parameterName +
								"=" +
								parameterValue;
							break;
						case "id_parent4":
							strParameter += "&";
							url +=
								"?id_parent1=" +
								"&id_parent2=" +
								"&id_parent3=" +
								strParameter +
								parameterName +
								"=" +
								parameterValue;
							break;

						default:
							break;
					}
				}
			}
		});
	}

	return url;
}

/* Hanlde search when click button */
function onSearch(obj) {
	const keyword = $("." + obj).val();
	if (keyword === "") return false;
	else {
		location.href = "?keyword=" + encodeURI(keyword);
	}
}

/* Change Event Category */
function onchangeCategory(elements = "", url, inputSearch = "") {
	let valueKeyword = $(inputSearch).val();

	if (valueKeyword) {
		const urlKeyword = url + "?keyword=" + encodeURI(valueKeyword);
		return (window.location.href = urlKeyword);
	}
	return (window.location = filterCategory(elements, url));
}

/* Reader image */
function readImage(inputFile, elementPhoto) {
	if (inputFile[0].files[0]) {
		if (inputFile[0].files[0].name.match(/.(jpg|jpeg|png|gif|webp)$/i)) {
			let size = parseInt(inputFile[0].files[0].size) / 1024;

			if (size <= 4096) {
				let reader = new FileReader();
				reader.onload = function (e) {
					$(elementPhoto).attr("src", e.target.result);
				};
				reader.readAsDataURL(inputFile[0].files[0]);
			} else {
				alert("Dung lượng ảnh lớn hơn dung lượng cho phép 4096kb");
				return false;
			}
		} else {
			$(elementPhoto).attr("src", "");
			alert("Định dạng hình ảnh không hợp lệ");
			return false;
		}
	} else {
		$(elementPhoto).attr("src", `${BASE_URL}public/images/noimage.png`);
		return false;
	}
}

/* Photo zone */
function photoZone(eDrag, iDrag, eLoad) {
	if ($(eDrag).length) {
		/* Drag over */
		$(eDrag).on("dragover", function () {
			$(this).addClass("drag-over");
			return false;
		});

		/* Drag leave */
		$(eDrag).on("dragleave", function () {
			$(this).removeClass("drag-over");
			return false;
		});

		/* Drop */
		$(eDrag).on("drop", function (e) {
			e.preventDefault();
			$(this).removeClass("drag-over");

			var lengthZone = e.originalEvent.dataTransfer.files.length;

			if (lengthZone == 1) {
				$(iDrag).prop("files", e.originalEvent.dataTransfer.files);
				readImage($(iDrag), eLoad);
			} else if (lengthZone > 1) {
				alert("Bạn chỉ được chọn 1 hình ảnh để upload");
				return false;
			} else {
				alert("Dữ liệu không hợp lệ");
				return false;
			}
		});

		/* File zone */
		$(iDrag).change(function () {
			readImage($(this), eLoad);
		});
	}
}

/* Handle generate slug */
function removeSpecialCharacter(str) {
	str = str.toLowerCase();
	str = str.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, "a");
	str = str.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, "e");
	str = str.replace(/i|í|ì|ỉ|ĩ|ị/gi, "i");
	str = str.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, "o");
	str = str.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, "u");
	str = str.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, "y");
	str = str.replace(/đ/gi, "d");
	str = str.replace(
		/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi,
		""
	);
	str = str.replace(/ /gi, "-");
	str = str.replace(/\-\-\-\-\-/gi, "-");
	str = str.replace(/\-\-\-\-/gi, "-");
	str = str.replace(/\-\-\-/gi, "-");
	str = str.replace(/\-\-/gi, "-");
	return str;
}

/* Create slug */
function generateSlug(value) {
	if (typeof value === "string") {
		return removeSpecialCharacter(value).replace(/\s/g, "-");
	}
}

/* Forseo */
function forSeo() {
	if ($(".for-seo")) {
		$(".for-seo").keyup(function (event) {
			const { value } = event.target;
			if (value) {
				$(".slug-seo").attr("value", generateSlug(value));
				$(".slug-seo").attr("readonly", true);
				$(".alert-slugvi").addClass("d-none");
			} else {
				$(".slug-seo").attr("value", "");
				$(".slug-seo").attr("readonly", false);
			}
		});
	}
}

/* Update num admin */
function ajaxUpdateNum(classNum, url) {
	if ($(classNum)) {
		$(classNum).change(function () {
			const value = $(this).val();
			const id = $(this).data("id");
			const table = $(this).data("table");
			const data = {
				id: id,
				value: value,
				table: table,
				_token: $("input[name='_token_num']").val(),
			};
			$.ajax({
				url: url,
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
}

/* Check status admin */
function ajaxStatus(classCheckSst, url) {
	if ($(classCheckSst)) {
		$(classCheckSst).change(function () {
			const status = $(this).attr("name");
			const id = $(this).data("id");
			const table = $(this).data("table");
			const data = {
				id: id,
				status: status,
				table: table,
				_token: $("input[name='_token']").val(),
			};
			$.ajax({
				url: url,
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
}

/* Notify */
function notifyDialog(
	content = "",
	title = "Thông báo",
	icon = "fas fa-exclamation-triangle",
	type = "blue"
) {
	$.alert({
		title: title,
		icon: icon, // font awesome
		type: type, // red, green, orange, blue, purple, dark
		content: content, // html, text
		backgroundDismiss: true,
		animationSpeed: 600,
		animation: "zoom",
		closeAnimation: "scale",
		typeAnimated: true,
		animateFromElement: false,
		autoClose: "accept|3000",
		escapeKey: "accept",
		buttons: {
			accept: {
				text: '<i class="fas fa-check align-middle mr-2"></i>Đồng ý',
				btnClass: "btn-blue btn-sm bg-gradient-primary",
			},
		},
	});
}

/* ConfirmDialog */
function confirmDialog(
	action,
	text,
	value,
	title = "Thông báo",
	icon = "fas fa-exclamation-triangle",
	type = "blue"
) {
	$.confirm({
		title: title,
		icon: icon, // font awesome
		type: type, // red, green, orange, blue, purple, dark
		content: text, // html, text
		backgroundDismiss: true,
		animationSpeed: 600,
		animation: "zoom",
		closeAnimation: "scale",
		typeAnimated: true,
		animateFromElement: false,
		autoClose: "cancel|3000",
		escapeKey: "cancel",
		buttons: {
			success: {
				text: '<i class="fas fa-check align-middle mr-2"></i>Đồng ý',
				btnClass: "btn-blue btn-sm bg-gradient-primary",
				action: function () {
					if (action == "delete-photo") document.location = value;
					if (action == "delete-photo2") document.location = value;
					if (action == "delete-item") document.location = value;
					if (action == "restore-item") document.location = value;
					if (action == "delete-all") {
						if ($(".form-product-list").length) {
							$(".form-product-list").attr("action", value);
							$(".form-product-list").submit();
						}
					}
					if (action == "restore-all") {
						if ($(".form-product-list").length) {
							$(".form-product-list").attr("action", value);
							$(".form-product-list").submit();
						}
					}
				},
			},
			cancel: {
				text: '<i class="fas fa-times align-middle mr-2"></i>Hủy',
				btnClass: "btn-red btn-sm bg-gradient-danger",
			},
		},
	});
}

/* Handle ajax render list gallery item */
function renderGalleryList() {
	$.ajax({
		url: `${BASE_URL}admin/product/upload_gallery`,
		method: "POST",
		success: function (data) {
			$("#preview").html(data);
		},
	});
}
