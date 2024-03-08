function doEnter(event, obj) {
	if (event.keyCode == 13 || event.which == 13) onSearch(obj);
}

function onSearch(obj) {
	var keyword = $("#" + obj).val();

	if (keyword == "") {
		alert("Từ khóa tìm kiếm chưa được nhập. Vui lòng thao tác lại!");
		return false;
	} else {
		window.location.href = baseUrl + "search?keyword=" + encodeURI(keyword);
	}
}

function doEye(obj) {
	if (obj) {
		obj.click(function () {
			if ($(this).hasClass("fa-eye")) {
				$(this).prev().attr("type", "text");
				$(this).addClass("fa-eye-slash");
				$(this).removeClass("fa-eye");
			} else {
				$(this).prev().attr("type", "password");
				$(this).removeClass("fa-eye-slash");
				$(this).addClass("fa-eye");
			}
		});
	}
}
