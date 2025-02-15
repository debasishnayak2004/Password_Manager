<!DOCTYPE html>
<html lang="en"  >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        #body {
            background: url('https://images.unsplash.com/photo-1574577457890-57d56460e04c?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 0px;
        }
        .card {
            background: rgb(255, 255, 255);
            border-radius: 10px;
        }
        .p{
            color: red;
        }
    </style>
</head>
<body id="content">
    <div id="body">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">

                    <div class="card-header text-center">
                        <h4>Register</h4>
                        <p class="text-danger" id="email_exist"></p>
                    </div>
                    
                                <div class="card-body">
                        <form action="action.php" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" required name="name" placeholder="Enter your full name">
                                <p id="nameerror" class="p"></p>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" required name="email" placeholder="Enter your email">
                                <p id="emailerror" class="p"></p>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
                                <p id="passworderror" class="p"></p>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirm Password<span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required placeholder="Confirm your password">
                                <p id="confirmerror" class="p"></p>
                                <p id="correcterror" class="p"></p>
                            </div>
                            <button type="submit" id="submit" class="btn btn-primary w-100">Register</button>
                        </form>
                        <div class="text-center mt-3">
                            <div>Already have an account? <a href="#" id="login">Login here</a></div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    </div>
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            //redirect login page 
            $("#login").click(function (e) {
                e.preventDefault();
                $("#content").load("login.php"); 
                history.pushState(null, null, "login.php");
            });

            // data insert in database
            $("#submit").on("click", function(event){
                event.preventDefault();
                let name = $("#name").val();
                let email = $("#email").val();
                let password = $("#password").val();
                let confirmPassword = $("#confirmPassword").val();
                // form validation 
                if(name == ""){
                    $("#nameerror").text("Please Enter Your Name.");
                }else{
                    $("#nameerror").text("");
                }
                if(email == ""){
                    $("#emailerror").text("Please Enter Your Email.");
                }else{
                    $("#emailerror").text("");
                }
                if(password == ""){
                    $("#passworderror").text("Please Enter Your Password.");
                }else{
                    $("#passworderror").text("");
                }
                if(confirmPassword == ""){
                    $("#confirmerror").text("Please Enter Your Confirm Password.");
                }else{
                    $("#confirmerror").text("");
                }

                if(confirmPassword == password){
                    $("#correcterror").text("");
                    // using ajex insert data in databese
                    if(name != "" && email != "" && password != "" && confirmPassword != ""){
                        $.ajax({
                        url : "action.php",
                        type: "POST",
                        data: {
                            "name": name,
                            "email": email,
                            "password": password

                        },
                        success : function(data){
                            $("#name").val("");
                            $("#email").val("");
                            $("#password").val("");
                            $("#confirmPassword").val("");
                            console.log(data);
                           if(data == "1"){
                            $("#content").load("login.php"); 
                             history.pushState(null, null, "login.php");
                           }if(data == "emailError"){
                            $("#email_exist").text("This Email Id Already Exists.");
                           }
                           
                        }

                    })
                    }

                }else{
                    $("#correcterror").text("Please Enter Your Correct Password.");
                }

                
            })
            
        });
    </script>
</body>
</html>
