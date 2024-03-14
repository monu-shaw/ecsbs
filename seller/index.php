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

<body>
    <div class="row mx-0">
        <div
            class="d-none col-md-6 col-lg-7 col-xl-8 c-bg-primary min-vh-100 d-md-flex flex-column justify-content-between c-text-forth">
            <div class="align-self-start">
                <h1>ECSBS</h1>
            </div>
            <div class="">
                <div class="splide" role="group" aria-label="Splide Basic HTML Example">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <li class="splide__slide">Slide 01</li>
                            <li class="splide__slide">Slide 02</li>
                            <li class="splide__slide">Slide 03</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="align-self-end">
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-5 col-xl-4 bg-dark m-h-100">
            <!-- Forms -->
            <div class="container m-1">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 mx-auto">
                        <div class="card bg-transparent c-text-third text-light">
                            <div class="card-header form-toggle">
                                <h3 class="card-title text-center" id="login-title">Login</h3>
                                <h3 class="card-title text-center d-none" id="signup-title">Sign Up</h3>
                            </div>
                            <div class="card-body">
                                <form id="userForm">
                                    <div id="login-form">
                                        <div class="mb-3">
                                            <label for="loginEmail" class="form-label">Email address</label>
                                            <input type="email" class="form-control" id="loginEmail"
                                                aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <label for="loginPassword" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="loginPassword">
                                        </div>
                                        <button type="button" class="btn btn-primary" id="loginButton">Login</button>
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
                                        <div class="mb-3 col-12">
                                            <label for="signupBusinessName" class="form-label">Business Name</label>
                                            <input type="text" class="form-control" id="signupBusinessName">
                                        </div>
                                        <div class="mb-3 col-12">
                                            <label for="signupBusinessAddress" class="form-label">Business
                                                Address</label>
                                            <textarea class="form-control" id="signupBusinessAddress"></textarea>
                                        </div>
                                        <div class="mb-3 col-12">
                                            <label for="signupPassword" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="signupPassword">
                                        </div>
                                        <div class="mb-3 col-12">
                                            <label for="signupConfirmPassword" class="form-label">Confirm
                                                Password</label>
                                            <input type="password" class="form-control" id="signupConfirmPassword">
                                        </div>
                                        <button type="button" class="btn btn-primary" id="signupButton">Sign Up</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <a href="#" class="link-primary" id="formToggle">New User? Sign Up</a>
                                <a href="#" class="link-primary d-none" id="formToggleBack">Existing User? Login</a>
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

        // Simulate successful login (replace with actual validation)
        alert(`Login successful for user: ${email}`);
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
                signup
            },  
            dataType:"json",
            success: function(response) {
                // Handle the response from the server
                console.log(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle errors
                console.error(textStatus, errorThrown);
            }
        });

    });

    // (Optional) Populate the country select element with countries (you can use an external API or a static list)
    fetch('https://api.countrystat.org/v1/countries') // Replace with your country data source
        .then(response => response.json())
        .then(data => {
            const countrySelect = document.getElementById('signupCountry');
            data.forEach(country => {
                const option = document.createElement('option');
                option.value = country.iso3;
                option.text = country.name;
                countrySelect.appendChild(option);
            });
        });
    </script>
</body>

</html>