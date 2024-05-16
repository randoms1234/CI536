document.getElementById("signup-form").addEventListener("submit", function(event) {
  event.preventDefault();
  
  var firstName = document.getElementById("first_name").value;
  var lastName = document.getElementById("last_name").value;
  var fullName = firstName + " " + lastName;
  var username = document.getElementById("username").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  var confirmPassword = document.getElementById("confirm_password").value;

  if (password !== confirmPassword) {
    document.getElementById("status").textContent = "Passwords entered do not match";
    return;
  }

  const signup = {
    full_name: fullName,
    username: username,
    email: email,
    password: password
  };

  fetch("php/signup_process.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(signup)
  })
  .then(response => response.json())
  .then(result => {
    if (result.success) {
      document.getElementById("status").textContent = "Account successfully created!";
      setTimeout(function() {
        window.location.href = "index.php";
      }, 2000);
    } else {
      document.getElementById("status").textContent = result.message;
    }
  })
  .catch(error => {
    console.error("Error:", error);
  });
});
