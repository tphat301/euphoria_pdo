function login() {
	let loginAttempts = 0;
	const maxLoginAttempts = 3;
	const username = document.getElementById("username").value;
	const password = document.getElementById("password").value;
	if (username === "admin" && password === "password") {
		alert("Login successful!");
		// Redirect to dashboard or another page
	} else {
		loginAttempts++;
		if (loginAttempts >= maxLoginAttempts) {
			alert("Đã đạt đến số lần đăng nhập tối đa. Vui lòng thử lại sau.");
			document.getElementById("loginForm").reset(); // Reset form
			document.getElementById("submitBtn").disabled = true; // Disable submit button
		} else {
			alert("Tên đăng nhập hoặc mật khẩu không chính xác. Vui lòng thử lại.!");
		}
	}
}

// function validateForm() {
// 	var username = document.getElementById("username").value;
// 	console.log(username);
// 	var email = document.getElementById("email").value;
// 	var password = document.getElementById("password").value;
// 	var error = document.getElementById("error");
// 	var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
// 	var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

// 	if (!username.trim()) {
// 		error.textContent = "Username is required.";
// 		return false;
// 	}

// 	if (!emailRegex.test(email)) {
// 		error.textContent = "Invalid email format.";
// 		return false;
// 	}

// 	if (!passwordRegex.test(password)) {
// 		error.textContent =
// 			"Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.";
// 		return false;
// 	}

// 	return true;
// }
