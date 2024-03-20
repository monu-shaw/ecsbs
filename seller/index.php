<?php
session_start();
if(isset($_SESSION["login"])){
    header("Location: home.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seller Login - ECSBS</title>
    <?php include_once("top.php");?>
    <style>
    .m-h-100 {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    </style>
</head>

<body class="form-bg">
    <div class="row mx-0">
        <div class="col-12 col-md-6 col-lg-5 col-xl-4 m-h-100 mx-auto tr-animate">
            <!-- Forms -->
            <div class="container m-1">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 mx-auto">
                        <div class="card shadow-lg tr-animate">
                            <div class="card-body c-text-forth">
                                <h3 class="text-center fw-semibold c-text-primary">ECSBS</h3>
                            <div class="form-toggle mb-2 mb-3">
                                <h5 class="card-title text-center" id="login-title">Login</h5>
                                <h5 class="card-title text-center d-none" id="signup-title">Register</h5>
                            </div>
                                <form id="userForm">
                                    <div id="login-form">
                                        <div class="mb-3">
                                            <label for="loginEmail" class="form-label">Email address</label>
                                            <input type="email" class="form-control" id="loginEmail"
                                                aria-describedby="emailHelp" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="loginPassword" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="loginPassword" required>
                                        </div>
                                        <button type="button" class="btn btn-primary w-100" id="loginButton">Login</button>
                                    </div>
                                    <div id="signup-form" class="d-none row mx-0">
                                        <div class="mb-3 col-12 col-md-6">
                                            <label for="signupEmail" class="form-label">Email address</label>
                                            <input type="email" class="form-control" id="signupEmail"
                                                aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3 col-12 col-md-6">
                                            <label for="signupPhone" class="form-label">Phone Number</label>
                                            <input type="tel" class="form-control" id="signupPhone">
                                        </div>
                                        <div class="mb-3 col-12">
                                            <label for="signupSellerName" class="form-label">Seller Name</label>
                                            <input type="text" class="form-control" id="signupSellerName">
                                        </div>
                                        <div class="mb-3 col-12 col-md-6">
                                            <label for="signupBusinessName" class="form-label">Business Name</label>
                                            <input type="text" class="form-control" id="signupBusinessName">
                                        </div>
                                        <div class="mb-3 col-12 col-md-6">
                                            <label for="signupBusinessName" class="form-label">Delivery Charge</label>
                                            <input type="text" class="form-control" id="deliveryCharge">
                                        </div>
                                        <div class="mb-3 col-12">
                                            <label for="signupBusinessAddress" class="form-label">Business Address</label>
                                            <textarea class="form-control" id="signupBusinessAddress"></textarea>
                                        </div>
                                        <div class="mb-3 col-12 col-md-6">
                                            <label for="signupPassword" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="signupPassword">
                                        </div>
                                        <div class="mb-3 col-12 col-md-6">
                                            <label for="signupConfirmPassword" class="form-label">Confirm
                                                Password</label>
                                            <input type="password" class="form-control" id="signupConfirmPassword">
                                        </div>
                                        <div class="mb-3 col-12">
                                            <button type="button" class="w-100 d-block btn btn-primary" id="signupButton">Register</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="text-center my-2">
                                <a href="#" class="link-primary text-decoration-none" id="formToggle">New User? Sign Up</a>
                                <a href="#" class="link-primary text-decoration-none d-none" id="formToggleBack">Existing User? Login</a>
                            </div>
                            <div class="card-footer">
                                <p class="text-center p-0 m-0">
                                    ECSBS Ecommerce Store Building System - Developed by <span class="fw-semibold">Monu kr. Shaw</span>  for in partial fulfillment for the Award of the degree <span class="fw-bold">BCA</span> , 2024.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Forms -->
        </div>
    </div>
    <?php include_once("bottom.php");?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var splide = new Splide('.splide', {
            type: 'loop',
            direction: 'ttb',
            height: '10rem',
            autoplay: true,
            pagination: false,
            arrows: false
        });
        splide.mount();
    });
    </script>
    <script>
    const loginForm = document.getElementById('login-form');
    const signupForm = document.getElementById('signup-form');
    const loginTitle = document.getElementById('login-title');
    const signupTitle = document.getElementById('signup-title');
    const formToggle = document.getElementById('formToggle');
    const formToggleBack = document.getElementById('formToggleBack');

    // Function to toggle between login and signup forms
    function toggleForms() {
        loginForm.classList.toggle('d-none');
        signupForm.classList.toggle('d-none');
        loginTitle.classList.toggle('d-none');
        signupTitle.classList.toggle('d-none');
        formToggle.classList.toggle('d-none');
        formToggleBack.classList.toggle('d-none');
    }

    // Event listener for form toggle links
    formToggle.addEventListener('click', toggleForms);
    formToggleBack.addEventListener('click', toggleForms);

    // Add functionality for login and signup button clicks (implementation depends on your backend)
    const loginButton = document.getElementById('loginButton');
    const signupButton = document.getElementById('signupButton');

    loginButton.addEventListener('click', () => {
        // Handle login form submission (e.g., send data to backend for validation)
        const email = document.getElementById('loginEmail').value;
        const password = document.getElementById('loginPassword').value;
        const login= "login"

        // Simulate successful login (replace with actual validation)
        $.ajax({
            type: "POST",
            url: "./server.php",
            data: {
                email: email,
                password: password,
                login
            },  
            dataType:"json",
            encode:true,
            success: function(response) {
                try {
                        let jsn = response
                        if(typeof(response) == 'string'){
                            jsn = JSON.parse(response);
                        }
                        if(jsn?.status == 200){
                            postLogin(response?.data)
                        }else{
                            if(response?.status==400){
                                response.data.forEach(element => {
                                    Toastify({
                                        text: element,
                                        className:"bg-danger text-light",
                                        duration: 3000
                                    }).showToast();
                                });
                            }
                        }
                    } catch (error) {
                        console.log(error.message);
                        alert("Error , Try Again");
                        location.reload();
                    }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle errors
                console.error(textStatus, errorThrown);
            }
        });
    });

    signupButton.addEventListener('click', () => {
        // Handle signup form submission (e.g., send data to backend for validation)
        const email = document.getElementById('signupEmail').value;
        const phone = document.getElementById('signupPhone').value;
        const sellerName = document.getElementById('signupSellerName').value;
        const businessName = document.getElementById('signupBusinessName').value;
        const businessAddress = document.getElementById('signupBusinessAddress').value;
        const country = "INDIA";
        const currency = "INR"
        const password = document.getElementById('signupPassword').value;
        const confirmPassword = document.getElementById('signupConfirmPassword').value;
        const signup= "signup"
        const deliveryCharge =document.getElementById("deliveryCharge").value;

        // Simulate successful signup (replace with actual validation)
        $.ajax({
            type: "POST",
            url: "./server.php",
            data: {
                email: email,
                phone: phone,
                sellerName: sellerName,
                businessName: businessName,
                businessAddress: businessAddress,
                country: country,
                currency: currency,
                password: password,
                confirmPassword: confirmPassword,
                signup,
                deliveryCharge
            },  
            dataType:"json",
            encode:true,
            success: function(response) {
                // Handle the response from the server
                try {
                        let jsn = response
                        if(typeof(response) == 'string'){
                            jsn = JSON.parse(response);
                        }
                        if(jsn?.data == 1){
                            location.reload();
                        }else{
                            if(response?.status==400){
                                response.data.forEach(element => {
                                    Toastify({
                                        text: element,
                                        className:"bg-danger text-light",
                                        duration: 3000
                                    }).showToast();
                                });
                            }
                        }
                    } catch (error) {
                        console.log(error.message);
                        alert("Error , Try Again");
                        location.reload();
                    }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle errors
                console.error(textStatus, errorThrown);
            }
        });

    });  
    const postLogin=(data)=>{
        localStorage.setItem("user",JSON.stringify(data))
        location.reload();
    }  
    </script>
</body>

</html>