<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Centered Bootstrap 5 Login Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    /* Renamed the class for clarity */
    .bg-cover {
      background: url('https://images.unsplash.com/photo-1614853035986-b230d7d5679c?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')
        no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
    }
  </style>
</head>
<body id="content">
  <!-- Flex container directly applied to center the card -->
  <div class="d-flex align-items-center justify-content-center bg-cover">
    <div class="card" style="width: 100%; max-width: 400px; border-radius: 10px;">
      <div class="card-header text-center">
        <h4>Login</h4>
        <p class="text-danger" id="not_match"></p>
      </div>
      <div class="card-body">
        <form>
          <div class="mb-3">
            <label for="email" class="form-label">Email address <span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" />
            <p class=" text-danger" id="emailerror"></p>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" />
            <p class=" text-danger" id="passworderror"></p>
          </div>
          <button type="submit" id="login_btn" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="text-center mt-3">
          <div>Don't have an account? <a href="#" id="register">Register here</a></div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <?php
          session_start();
          if(isset($_SESSION["register"]) && $_SESSION["register"] == "register"){
            echo "<script> alert('Register Success')</script>";
            $_SESSION["register"] = "";
          }

        ?>
  <script>
        $(document).ready(function () {
          // page reload 
            $("#register").click(function (e) {
                e.preventDefault();
                $("#content").load("index.php"); 
                history.pushState(null, null, "index.php"); 
            });
            // login
            $("#login_btn").on("click", function(event){
              event.preventDefault();
              let email = $("#email").val();
            let password = $("#password").val();
              // form validation 
              if(email == ""){
                $("#emailerror").text("Please Enter Your Email Id.");
              }else{
                $("#emailerror").text("");
              }
              if(password == ""){
                $("#passworderror").text("Please Enter Your Password.");
              }else{
                $("#passworderror").text("");
              }
              // ajax call 
              if(email != "" && password != ""){
                $("#email").val("");
                $("#password").val("");
                $.ajax({
                  url: "login_action.php",
                  type: "POST",
                  data: {
                    "email": `${email}`,
                    "password": `${password}`
                  },
                  success: function(data){
                    if(data == "1"){
                      $("#content").load("dashboard.php"); 
                      history.pushState(null, null, "dashboard.php");
                    }
                    if(data == "0"){
                      $("#not_match").text("Your Email & Password Does Not Match.");
                    }else{
                      $("#not_match").text("");
                    }
                  }
                })
              }
            });
        });
    </script>
</body>
</html>
