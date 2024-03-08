tinymce.init({
	selector: "textarea.tiny",
	plugins:
		"anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount",
	toolbar:
		"undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat",
	file_picker_types: "file image media",
	file_picker_callback: (callback, value, meta) => {
		if (meta.filetype == "image") {
			let input = document.querySelector(".my-file");
			if (input) {
				input.click();
				input.onchange = function () {
					let file = input.files[0];
					let reader = new FileReader();
					reader.onload = function (e) {
						callback(e.target.result, {
							alt: file.name,
						});
					};
					reader.readAsDataURL(file);
				};
			}
		}
		if (meta.filetype == "media") {
			let input = document.querySelector(".my-file2");
			if (input) {
				input.click();
				input.onchange = function () {
					let file = input.files[0];
					let reader = new FileReader();
					reader.onload = function (e) {
						callback(e.target.result, {
							alt: file.name,
						});
					};
					reader.readAsDataURL(file);
				};
			}
		}
	},
});

window.addEventListener("DOMContentLoaded", function () {
	const uploadPhoto = document.querySelectorAll(".upload_photo");
	/* Handle preview change photo module */
	if (uploadPhoto) {
		[...uploadPhoto].forEach((item) =>
			item.addEventListener("change", function (e) {
				const order = e.currentTarget.dataset.order;
				if (e.target.files.length) {
					const src = URL.createObjectURL(e.target.files[0]);
					const uploadPhotoPreview = document.querySelector(
						`.upload_photo_preview_${order}`
					);
					uploadPhotoPreview.src = src;
				}
			})
		);
	}
	const uploadPhotoDetail = document.getElementById("upload_photo_detail");
	const uploadPhotoPreviewDetail = document.querySelector(
		".upload_photo_detail_preview"
	);
	/* Handle preview change photo detail module */
	if (uploadPhotoDetail) {
		uploadPhotoDetail.addEventListener("change", function (e) {
			if (e.target.files.length) {
				const src = URL.createObjectURL(e.target.files[0]);
				uploadPhotoPreviewDetail.src = src;
			}
		});
	}
});
