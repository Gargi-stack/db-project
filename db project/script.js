// Example predefined user for login validation
const validUser = {
    username: "user123",
    password: "password123"
};

// Login form validation
document.getElementById("login").addEventListener("submit", function(event) {
    event.preventDefault();

    let username = document.getElementById("login-username").value;
    let password = document.getElementById("login-password").value;

    if (username === validUser.username && password === validUser.password) {
        alert("Login successful!");
        window.location.href = "homepage.html";  // Redirect to homepage
    } else {
        alert("Invalid username or password!");
    }
});

// Signup form validation
document.getElementById("signup").addEventListener("submit", function(event) {
    event.preventDefault();

    let username = document.getElementById("signup-username").value;
    let password = document.getElementById("signup-password").value;
    let confirmPassword = document.getElementById("confirm-password").value;

    if (password === confirmPassword) {
        alert("Signup successful!");
        // You can store new user details or proceed with signup logic
        window.location.href = "homepage.html";  // Redirect to homepage
    } else {
        alert("Passwords do not match!");
    }
});
