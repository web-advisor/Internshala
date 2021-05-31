<?php
include_once("functions.php");

$error = "";

// ------------------------ Identifying and Storing Type of User --------------------- 
if ($_GET["process"] == "type" && isset($_POST["type"])) {
    $_SESSION["type"] = $_POST["type"];
    unset($_POST["type"]);
    echo 1;
} else {
    echo 0;
}




// ------------------------ Sign Up Action ---------------------------
if (isset($_SESSION["type"]) && $_GET["process"] == "signup") {

    //  Form Validation ------------
    if (!$_POST["email"]) {
        $error .= "<br>An Email is required. ";
    } else if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) {
        $error .= "<br>Entered Email Address is Invalid.";
    }
    if (!$_POST["password"]) {
        $error .= "<br>A Password is required. ";
    }
    if ($error != "") {
        echo "Your Form has the following Problem(s) : " . $error;
        exit();
    }

    // --------------- Checking if the Signing Up input email is already taken ------------
    // ------- Depending on type of User Selecting Relation -------
    $type = $_SESSION["type"];
    $sql = "SELECT * FROM `" . $type . "` WHERE `email` = '" . mysqli_real_escape_string($link, $_POST['email']) . "' LIMIT 1";
    $result = mysqli_query($link, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $error = "This Email id is already taken !";
    } else {
        //  ---------------- Siging up if no user found with entered email ----------
        $query = "INSERT INTO `" . $type . "` " . "(`email`,`password`,`code`)" . " VALUES " . "('" . mysqli_real_escape_string($link, $_POST['email']) . "','" . mysqli_real_escape_string($link, $_POST['password']) . "','" . mysqli_real_escape_string($link, substr(md5($_POST['email']), 3, 2) . substr(md5(rand(1, 999)), 2, 4)) . "')";
        $resultQuery = mysqli_query($link, $query);
        if ($resultQuery) {
            $id = mysqli_insert_id($link);
            $_SESSION['id'] = $id;

            // ---------------- Password Hashing --------------------- 
            $query = "UPDATE `" . $type . "` SET `password` = '" . md5(md5($_SESSION['id']) . $_POST['password']) . "' WHERE `id`=" . $id . " LIMIT 1";
            mysqli_query($link, $query);

            $status=0.0;
            $typeQuery = "INSERT INTO `type` " . "(`type`,`userid`,`status`) " . " VALUES " . " ('" . mysqli_real_escape_string($link, $type) . "','" . mysqli_real_escape_string($link, $id) . "','" . mysqli_real_escape_string($link, $status) . "')";
            mysqli_query($link, $typeQuery);
            echo mysqli_error($link);
            echo 1;
        } else {
            // $error = mysqli_error($link);
            $error = "Couldn't Create User - Please try again later ";
        }
    }
    if ($error != "") {
        echo $error;
        exit();
    }
}

//   -------------------------------- Log In action ----------------------------
if ($_GET["process"] == "login") {

    // Form Validation ----  
    if (!$_POST["email"]) {
        $error .= "<br>An Email is required. ";
    }
    if (!$_POST["password"]) {
        $error .= "<br>A Password is required. ";
    }
    if ($error != "") {
        echo $error;
        exit();
    }
    $type = $_SESSION["type"];

    // ------ Signing in the user after checking if email Password Match ------ 
    $login = "SELECT * FROM `" . $type . "` WHERE `email` = '" . mysqli_real_escape_string($link, $_POST['email']) . "' LIMIT 1";
    // $queryLogIn = "SELECT * FROM `" . $type . "` WHERE `email` = '" . mysqli_real_escape_string($link, $_POST['email']) . "' LIMIT 1";
    $resultLogIn = mysqli_query($link, $login);
    if ($resultLogIn && mysqli_num_rows($resultLogIn) > 0) {
        $row = mysqli_fetch_assoc($resultLogIn);
        if ($row['password'] == md5(md5($row['id']) . $_POST['password'])) {
            $id = $row['id'];
            $_SESSION['id'] = $id;
            echo 1;
        } else {
            $error = "Could not find that Username-Password Combination ! Please try Again !";
        }
    } else {
        // $error = mysqli_error($link);
        $error = "Could not find the Email in the database.";
    }

    if ($error != "") {
        echo $error;
        exit();
    }
}
