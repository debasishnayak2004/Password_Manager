<?php
session_start();
if(!(isset( $_SESSION["emailLogin"]))){
    header("location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #f8f9fa;
            color: #212529;
        }
        .container {
            max-width: 900px;
        }
        .navbar {
            background-color: #6f42c1;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .card {
            margin-bottom: 20px;
        }
        .dark-mode {
            background-color: #212529;
            color: white;
        }
        .dark-mode .card {
            background-color: #343a40;
            color: white;
        }
        .dark-mode .navbar {
            background-color: #000;
        }
        .footer {
            background-color: #6f42c1;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }
        .dark-mode .footer {
            background-color: #000;
        }
        #card_modal{
      background-color: rgba(0, 0, 0, 0.7);
      width: 100%;
      height: 100%;
      top: 0;
      bottom: 0;
      left: 0;
      position: fixed;
      z-index: 999;
      display: none;
    }
    #card_modal_form{
      background-color: white;
      padding: 30px;
      width: 40%;
      position: relative;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      border-radius: 10px;
     
    }
    #card_close-btn {
      width: 30px;
      width: 30px;
      background-color: red;
      color: white;
      text-align: center;
      border-radius: 50%;
      position: absolute;
      top: -15px;
      right: -15px;
      cursor: pointer;
    }
 
    #password_modal{
      background-color: rgba(0, 0, 0, 0.7);
      width: 100%;
      height: 100%;
      top: 0;
      bottom: 0;
      left: 0;
      position: fixed;
      z-index: 999;
      display: none;
    }
    #password_modal_form{
      background-color: white;
      padding: 30px;
      width: 40%;
      position: relative;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      border-radius: 10px;
     
    }
    #password_close-btn {
      width: 30px;
      width: 30px;
      background-color: red;
      color: white;
      text-align: center;
      border-radius: 50%;
      position: absolute;
      top: -15px;
      right: -15px;
      cursor: pointer;
    }

    #delete_btn,#edit_btn,#delete_p_btn,#edit_p_btn{
        cursor: pointer;
    }
    @media only screen and (max-width: 950px) {
     #card_modal_form {
        width: 80%;
  }
    #password_modal_form {
            width: 80%;
    }
}
    </style>
</head>
<body>

    <div id="content">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SecureBox</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu"  aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item "  href="#">View Profile</a></li>
                            <li><a class="dropdown-item " href="#">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item " href="#" id="logoutBtn">Logout</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ms-3">
                        <button class="btn btn-light" id="toggleDarkMode">🌙 Dark Mode</button>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid mt-4">
        <h2 class="text-center">Password Manager</h2>
        <div class="row">
            <div class="col-md-6">

                <div class="alert alert-success alert-dismissible d-none" id="card_success">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Your card details have been added successfully!</strong>
                </div>
                <div class="card p-3">
                    <h4>Add a Credit Card</h4>
                    <form>
                        <input type="hidden" id="email" name="email" value="<?php echo  $_SESSION["emailLogin"];   ?>">
                        <div class="mb-3">
                            <label class="form-label">Card Number</label>
                            <input type="text" class="form-control" name="number" id="number" placeholder="Your Card Number">
                            <p class="text-danger" id="card_number_error"></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Expiry Date</label>
                            <input type="date" class="form-control" name="expiry" id="expiry" placeholder="MM/YY">
                            <p class="text-danger" id="card_expiry_error"></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Card CVV</label>
                            <input type="text" class="form-control" name="cvv" id="cvv" placeholder="CVV">
                            <p class="text-danger" id="card_cvv_error"></p>
                        </div>
                        <button class="btn btn-primary" id="card_btn">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible d-none" id="password_success">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Your Password details have been added successfully!</strong>
                    </div>

                <div class="card p-3">
                    <h4>Add a Password</h4>
                    <form>
                    <input type="hidden" id="email" name="email" value="<?php echo  $_SESSION["emailLogin"];   ?>">
                        <div class="mb-3">
                            <label class="form-label">Website</label>
                            <input type="text" class="form-control" name="url" id="url" placeholder="https://example.com">
                                <p class="text-danger" id="password_url_error"></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Your username">
                            <p class="text-danger" id="password_user_name_error"></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            <p class="text-danger" id="password_password_error"></p>
                        </div>
                        <button class="btn btn-primary" id="password_btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 ">
                <div class="card p-3">
                    <h4 class="text-center text-decoration-underline">Your Cards</h4>
                    <!-- no data  -->
                     <div id="card_no_data">

                     </div>
                    <div class="table-responsive" id="card_table">
                    <table class="table table-borderless table-hover">
                        <thead >
                            <tr>
                                <th>Sl.No</th>
                                <th>Number</th>
                                <th>Expiry</th>
                                <th>Cvv</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody id="card_data">
                            
                        </tbody>
                    </table>
                    </div>
                   

                    
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-3">
                    <h4 class="text-center text-decoration-underline">Your Passwords</h4>
                    
                    <!-- no data  -->
                    <div id="password_no_data">

                    </div>
                    <div class="table-responsive" id="password_table">
                    <table class="table table-borderless table-hover">
                    <thead class="">
                        <tr>
                            <th>Sl.No</th>
                            <th>Website</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody id="password_data">
                        
                    </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card modal form -->
    <div  id="card_modal">
        
        <div id="card_modal_form">
                    <h5 class="pb-2 text-center text-success text-decoration-underline">Card Details Update</h5>
                    <form>
                            <input type="hidden" id="modal_id" name="modal_id">
                            <div class="mb-3">
                                <label class="form-label">Card Number</label>
                                <input type="text" class="form-control" name="modal_number" id="modal_number" placeholder="Your Card Number">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Expiry Date</label>
                                <input type="date" class="form-control" name="modal_expiry" id="modal_expiry" placeholder="MM/YY">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Card CVV</label>
                                <input type="text" class="form-control" name="modal_cvv" id="modal_cvv" placeholder="CVV">
                            </div>
                            <button class="btn btn-primary" id="modal_btn_update">Update</button>
                        </form>
            <div id="card_close-btn">
                <i class="fa-solid fa-x"></i>
            </div>
        </div>
    
    </div>

    <!-- password modal form -->
    <div  id="password_modal">
        
        <div id="password_modal_form">
                    <h5 class="pb-2 text-center text-success text-decoration-underline">Password Details Update</h5>
                    <form>
                            <input type="hidden" id="password_modal_id" name="password_modal_id">
                            <div class="mb-3">
                                <label class="form-label">Website</label>
                                <input type="text" class="form-control" name="password_modal_url" id="password_modal_url" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">User Name</label>
                                <input type="text" class="form-control" name="password_modal_userName" id="password_modal_userName" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="text" class="form-control" name="password_modal_password" id="password_modal_password" >
                            </div>
                            <button class="btn btn-primary" id="modal_password_update">Update</button>
                        </form>
            <div id="password_close-btn">
                <i class="fa-solid fa-x"></i>
            </div>
        </div>
    
    </div>
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 SecureBox. All rights reserved.</p>
        </div>
    </footer>
    </div>
 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('toggleDarkMode').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            if (document.body.classList.contains('dark-mode')) {
                this.textContent = '☀️ Light Mode';
                this.classList.remove('btn-light');
                this.classList.add('btn-dark');
                document.getElementById("card_no_data").classList.add('text-white');
                document.getElementById("password_no_data").classList.add('text-white');
            } else {
                this.textContent = '🌙 Dark Mode';
                this.classList.remove('btn-dark');
                this.classList.add('btn-light');
                document.getElementById("card_no_data").classList.remove('text-white');
                document.getElementById("password_no_data").classList.remove('text-white');
                
            }
        });

       

    </script>
    <script>
        $(document).ready(function(){
            // logout button
            $("#logoutBtn").on("click", function(event){
                event.preventDefault();
                $.ajax({
                    url: "logout.php",
                    type: "get",
                    success: function(data){
                        if(data == "1"){
                            $("#content").load("login.php"); 
                            history.pushState(null, null, "login.php");
                        }
                    }
                })
            });

            // card data show
            function datashow(){
                $.ajax({
                    url: "card_show.php",
                    type: "get",
                    success: function(data){
                        if(data.length === 0){
                            $("#card_table").hide();
                            $("#card_no_data").html(`
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <i class="fa fa-exclamation-circle"></i> No data available
                                    </td>
                                </tr>
                            `);
                        }else{
                            $("#card_no_data").html("");
                            $("#card_table").show();
                            let sl = 1;
                            $(data).each(function(index, value) {
                                $("#card_data").append(`<tr> <td>${sl}</td> <td>${value['number']}</td> <td>${value['expiry']}</td> <td>${value['cvv']}</td> <td><p id='delete_btn' data-deid='${value['id']}' class=' text-danger'>Delete</p></td>  <td><p id='edit_btn' data-edid='${value['id']}' class=' text-success'>Edit</p></td> </tr>`);
                                sl++;
                            })
                        }
                
                        
                    }
                });
            };
            datashow();
                // card  data insert 
            $("#card_btn").on("click", function(event){
                event.preventDefault();
                let number = $("#number").val();
                let expiry = $("#expiry").val();
                let cvv = $("#cvv").val();
                let email = $("#email").val();
                // form validation
                if(number == ""){
                    $("#card_number_error").text("Please Enter Your Card Numbers.");
                }else{
                    $("#card_number_error").text("");
                }
                if(expiry == ""){
                    $("#card_expiry_error").text("Please Enter Your Card Expiry Date.");
                }else{
                    $("#card_expiry_error").text("");
                }
                if(cvv == ""){
                    $("#card_cvv_error").text("Please Enter Your Card Cvv Numbers.");
                }else{
                    $("#card_cvv_error").text("");
                }

                if(number != "" && expiry != "" && cvv != ""){
                        $.ajax({
                        url: "insert_action.php",
                        type: "post",
                        data: {
                            "email": `${email}`,
                            "number": `${number}`,
                            "expiry": `${expiry}`,
                            "cvv": `${cvv}`,
                        },
                        success: function(data){
                            $("#number").val("");
                            $("#expiry").val("");
                            $("#cvv").val("");
                            if(data == "1"){
                                $("#card_data").html("");
                                datashow();
                                $("#card_success").removeClass("d-none");
                                
                            }else{
                                $("#card_success").addClass("d-none");
                            }
                        }
                    })
                }
                
                
            });

            

            // card model update form close
            $("#card_close-btn").on("click", function(){
                $("#card_modal").hide();
            });

            // card data show in modal form
            $(document).on("click", "#edit_btn", function(){
                $("#card_modal").show();
                let id = $(this).data("edid");
                $.ajax({
                    url: "update_card.php",
                    type: "post",
                    data: {
                        "id": `${id}`
                    },
                    success: function(data){
                        $("#modal_id").val(data[0].id);
                        $("#modal_number").val(data[0].number);
                        $("#modal_expiry").val(data[0].expiry);
                        $("#modal_cvv").val(data[0].cvv);
                    }
                })
            });

            // card data update in database

            $("#modal_btn_update").on("click", function(event){
                event.preventDefault();
                    let id = $("#modal_id").val();
                    let number = $("#modal_number").val();
                    let expiry = $("#modal_expiry").val();
                    let cvv = $("#modal_cvv").val();
                    $.ajax({
                        url: "update_card_action.php",
                        type: "POST",
                        data: {
                                id: `${id}`,
                                number: `${number}`,
                                expiry: `${expiry}`,
                                cvv: `${cvv}`

                            },
                        success: function(data){
                            if(data == "1"){
                                $("#card_modal").hide();
                                alert("Your Card Details Update success");
                                $("#card_data").html("");
                                datashow();

                            }
                        }
                    });
            });
            
            // delete card data
            $(document).on("click", "#delete_btn", function(){
                let id = $(this).data("deid");
                if(confirm("Are You Sure Delete Your Card Details")){
                    $.ajax({
                    url: "delete_card.php",
                    type: "post",
                    data: {
                        "id": `${id}`
                    },
                    success: function(data){
                        if(data == "1"){
                            $("#card_data").html("");
                            datashow();
                            alert("Delete Card Details Successful");

                        }
                    }
                })
                }
            })

            // passsword section start

            // password data show
            function passwordShow(){
                $.ajax({
                    url: "password_show.php",
                    type: "get",
                    success: function(data){
                        if(data.length === 0){
                            $("#password_table").hide();
                            $("#password_no_data").html(`
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <i class="fa fa-exclamation-circle"></i> No data available
                                    </td>
                                </tr>
                            `);
                        }else{
                            $("#password_no_data").html("");
                            $("#password_table").show();
                            let sl = 1;
                            $(data).each(function(index, value) {
                                $("#password_data").append(`<tr> <td>${sl}</td> <td> <a href="${value['url']}" target="_blank">${value['url']}</a></td> <td>${value['user_name']}</td> <td>${value['password']}</td> <td><p id='delete_p_btn' data-dpid='${value['id']}' class='text-danger'>Delete</p></td>  <td><p id='edit_p_btn' data-epid='${value['id']}' class='text-success'>Edit</p></td> </tr>`);
                                sl++;
                            })
                        }
                
                        
                    }
                });
            };
            passwordShow();

            // password data insert in database
            $("#password_btn").on("click", function(event){
                event.preventDefault();
                let url = $("#url").val();
                let userName = $("#user_name").val();
                let password = $("#password").val();
                let email = $("#email").val();
                // form validation
                if(url == ""){
                    $("#password_url_error").text("Please Enter Your Website Url.");
                }else{
                    $("#password_url_error").text("");
                }
                if(userName == ""){
                    $("#password_user_name_error").text("Please Enter Your User Name.");
                }else{
                    $("#password_user_name_error").text("");
                }
                if(password == ""){
                    $("#password_password_error").text("Please Enter Your Password.");
                }else{
                    $("#password_password_error").text("");
                }

                if(url != "" && userName != "" && password != ""){
                        $.ajax({
                        url: "insert_password.php",
                        type: "post",
                        data: {
                            "email": `${email}`,
                            "url": `${url}`,
                            "userName": `${userName}`,
                            "password": `${password}`,
                        },
                        success: function(data){
                            $("#url").val("");
                            $("#user_name").val("");
                            $("#password").val("");
                            if(data == "1"){
                                $("#password_data").html("");
                                passwordShow();
                                $("#password_success").removeClass("d-none");
                                
                            }else{
                                $("#password_success").addClass("d-none");
                            }
                        }
                    })
                }
                
                
            });

            // delete password data in database
            $(document).on("click", "#delete_p_btn", function(){
                let id = $(this).data("dpid");
                if(confirm("Are You Sure Delete Your Password")){
                    $.ajax({
                    url: "delete_password.php",
                    type: "post",
                    data: {
                        "id": `${id}`
                    },
                    success: function(data){
                        if(data == "1"){
                            $("#password_data").html("");
                                passwordShow();
                            alert("Delete Password Details Successful");

                        }
                    }
                })
                }
            });

            // password model update form close
            $("#password_close-btn").on("click", function(){
                $("#password_modal").hide();
            });

            // password data show in modal form
            $(document).on("click", "#edit_p_btn", function(){
                $("#password_modal").show();
                let id = $(this).data("epid");
                $.ajax({
                    url: "update_password.php",
                    type: "post",
                    data: {
                        "id": `${id}`
                    },
                    success: function(data){
                        $("#password_modal_id").val(data[0].id);
                        $("#password_modal_url").val(data[0].url);
                        $("#password_modal_userName").val(data[0].user_name);
                        $("#password_modal_password").val(data[0].password);
                    }
                })
            });

             // password data update in database

             $("#modal_password_update").on("click", function(event){
                event.preventDefault();
                    let id = $("#password_modal_id").val();
                    let url = $("#password_modal_url").val();
                    let user_name = $("#password_modal_userName").val();
                    let password = $("#password_modal_password").val();
                    $.ajax({
                        url: "update_password_action.php",
                        type: "POST",
                        data: {
                                id: `${id}`,
                                url: `${url}`,
                                user_name: `${user_name}`,
                                password: `${password}`

                            },
                        success: function(data){
                            if(data == "1"){
                                $("#password_modal").hide();
                                alert("Your Password Details Update success");
                                $("#password_data").html("");
                                passwordShow();

                            }
                        }
                    });
            });
        });
    </script>
</body>
</html>
