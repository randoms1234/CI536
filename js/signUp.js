document.getElementById("signup-form").addEventListener("submit", function(event) {
  event.preventDefault();
  

    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var confirm_password = document.getElementById("confirm_password").value;
  
    if(password !== confirm_password){
      document.getElementById("status").textContent = "Passwords entered do not match";
      return; 
    }

    const signup = {
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
      if(result.success){
        document.getElementById("status").textContent = "Account successfully created!";

        setTimeout(function (){
          window.location.href = "index.php";
        }, 2000);
      } 
      
      else{
        document.getElementById("status").textContent = result.message;
      }
    })
    .catch(error => {
      console.error("Error:", error);
    });
  });
