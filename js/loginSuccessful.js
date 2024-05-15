document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("login-form").addEventListener("submit", function(event) {
    event.preventDefault();

    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    const login = {
      username: username,
      password: password
    };

    fetch("php/login_process.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
    },
      body: JSON.stringify(login)
    })
    .then(response => response.json())
    .then(result => {
        if(result.success){
          document.getElementById("message").textContent = "Success, redirecting";

          setTimeout(function () {
            window.location.href = "index.php";
          }, 2000);
        } 
        
        else{
          document.getElementById("message").textContent = result.message;
        }
      })
      .catch(error => {
        console.error("Error:", error);
      });
  });
});