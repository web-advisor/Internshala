<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Amar Sinha -> https://github.com/web-advisor">
    <meta name="keywords" content="foodshala, online restaurant, restaurant, chef, chef near me">
    <meta name="description" content="Order food online from restaurants and get it delivered. ">

    <!-- Logo -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="assets/images/favicon_io/site.webmanifest">

    <!-- Title -->
    <title>foodshala</title>

    <!-- stylesheets -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" version="1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/style-for-tablet.css" version="1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/style-for-mobile.css" version="1.0">

</head>

<body>

    <div id="load">
        <img src="assets/images/loading.gif" alt="Loading...">
    </div>


    <!-- ------------------- Navigatiion Bar --------------------------------- -->
    <nav class="navbar navbar-expand-md navbar-bg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <!-- <img src="assets/images/logo.svg" alt="FS" width="32px" height="32px"> -->
                <img src="assets/images/loading.gif" alt="FS" width="55px" height="55px">
                <!-- <img src="assets/images/text-logo.svg" alt="FOODSHALA" width="210px" height="50px"> -->
                <!-- <img src="assets/images/logo-header.png" alt="FOODSHALA" width="116.67px" height="55px"> -->
                <!-- <img src="assets/images/text-logo.png" alt="FOODSHALA" width="210px" height="50px"> -->
                <!-- <img src="assets/images/logo-header.svg" alt="FOODSHALA" width="210px" height="50px"> -->
                <span style="color:#220099cc;"> FOOD</span><span style="color:#000;">SHALA</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="?page=menu">
                            <?php if (isset($_SESSION["id"])) {  ?>
                                <?php if (isset($_SESSION["type"]) && $_SESSION["type"] == "customers") echo "Search";
                                else if (isset($_SESSION["type"]) && $_SESSION["type"] == "restaurant") echo "Market"; ?>
                            <?php } else {
                                echo "Search";
                            } ?>
                        </a>
                    </li>
                    <?php if (isset($_SESSION["id"])) { ?>
                        <li class="nav-item">
                            <?php if (isset($_SESSION["type"]) && $_SESSION["type"] == "customers") echo '<a class="nav-link" href="?page=cart">Cart</a>';
                            else if (isset($_SESSION["type"]) && $_SESSION["type"] == "restaurant") echo '<a class="nav-link" href="?page=order">Order</a>'; ?>
                        </li>
                    <?php } ?>
                    <?php if (isset($_SESSION["id"])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=profile">
                                Profile
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (isset($_SESSION['id'])) { ?>
                        <button type="button" id="log-out-button" class="btn btn-md btn-pill btn-default" style="cursor:pointer;"><a href="?process=logout" style="text-decoration:none; font-weight:bolder; color:#fff;">Logout</a></button>
                    <?php } else {   ?>
                        <li class="nav-item" id="sign-up-button">
                            <a class="nav-link" href="#">Sign Up</a>
                        </li>
                    <?php  }  ?>

                </ul>
            </div>
        </div>
    </nav>

    <!-- -------------------- User Type Declaration ------------------------------------------>
    <div class="container" id="user-type">
        <div class="row">
            <div class="col-sm-6 welcome" id="restaurant-welcome">
                <img src="assets/images/restaurant-welcome.jpg" id="restaurant-img" class="welcome-img">
                <div class="container">
                    <div class="overlay">
                        <a href="#" class="icon" title="User Profile">
                            <i class="fa fa-user"></i>
                        </a>
                    </div>
                    <p class="entry-text">Restaurant</p>
                </div>
                <!-- <button type="button" id="restaurant-entry" class="btn btn-lg entry-btn">Enter</button> -->
            </div>

            <div class="col-sm-6 welcome" id="customer-welcome">
                <img src="assets/images/customer-welcome.jpg" id="customer-img" class="welcome-img">
                <div class="container">
                    <div class="overlay">
                        <a href="#" class="icon" title="User Profile">
                            <i class="fa fa-user"></i>
                        </a>
                    </div>
                    <p class="entry-text">Customer</p>
                </div>
                <!-- <button id="customer-entry" type="button" class="btn btn-lg entry-btn">Enter</button> -->
            </div>
        </div>
    </div>


    <!-- ----------------------------- Sign Up Form  ------------------------------------- -->

    <!-- ------ Sign Up Form Div ----------------->
    <div id="sign-up">
        <form method="post">
            <div class="error alert alert-danger" role="alert">
                <?php
                if (isset($error) && $error != "") {
                    echo $error;
                }
                ?>
            </div>
            <div class="form-group">
                <label for="sign-up-email">Email address</label>
                <input autocomplete="off" type="email" class="w3-input w3-animate-input" style="width:20vw" id="sign-up-email" name="sign-up-email">
            </div>
            <div class="form-group">
                <label for="sign-up-password">Password</label>
                <input autocomplete="off" type="password" class="w3-input w3-animate-input" style="width:20vw" id="sign-up-password" name="sign-up-password">
            </div>
            <button type="button" id="sign-up-submit" class="btn submit">Sign Up</button>
            <a href="#" id="log-in-instead">Log In Instead</a>
        </form>
    </div>

    <!-- Sign In Form Div -->
    <div id="log-in" class="w3-container w3-center w3-animate-zoom">
        <form>
            <div class="error alert alert-danger" role="alert">
                <?php
                if (isset($error) && $error != "") {
                    echo $error;
                }
                ?>
            </div>
            <div class="form-group">
                <label for="log-in-email">Email Address</label>
                <input autocomplete="off" type="text" class="w3-input w3-animate-input" id="log-in-email" style="width:20vw" name="log-in-email">
            </div>
            <div class="form-group">
                <label for="log-in-password">Password</label>
                <input autocomplete="off" type="password" class="w3-input w3-animate-input" id="log-in-password" style="width:20vw" name="log-in-password">
            </div>
            <button type="button" id="log-in-submit" class="btn submit">Log In</button>
            <a href="#" id="sign-up-instead">Sign Up Instead</a>
        </form>
    </div>