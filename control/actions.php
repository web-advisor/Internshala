<?php
include_once("functions.php");

$error = "";

// ------------------------ Identifying and Storing Type of User --------------------- 
if ($_GET["process"] == "type" && isset($_POST["type"])) {
    $_SESSION["type"] = $_POST["type"];
    unset($_POST["type"]);
    echo 1;
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

// ---------------------------------------------------------- Profile Set Up ---------------------------------------::
if($_GET["process"]=="profile-setup"){    
    // Managing Prsnl Info ::
    $type=$_SESSION["type"];
    $relation=substr($type,0,4)."_";

    if($type=="customers"){
        $existCheck="SELECT `".$relation."id` FROM `".$relation."details` WHERE `".$relation."id` = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
        $resultEC=mysqli_query($link,$existCheck);
        if($resultEC && mysqli_num_rows($resultEC)>0){
            $updatingInfo="UPDATE `".$relation."details`
                SET `name`='".mysqli_real_escape_string($link,$_POST['name'])."',
                    `phone`='".mysqli_real_escape_string($link,$_POST['phone'])."',
                    `preferences`='".mysqli_real_escape_string($link,$_POST['preferences'])."'
                WHERE `".$relation."id`='".mysqli_real_escape_string($link,$_SESSION['id'])."'";
            $resultInfo=mysqli_query($link,$updatingInfo);
            echo "1"; 
        }else{
            $insertingInfo="INSERT into `".$relation."details` (`".$relation."id`,`name`,`phone`,`preferences`) 
            VALUES ('".mysqli_real_escape_string($link,$_SESSION['id'])."',
                    '".mysqli_real_escape_string($link,$_POST['name'])."',
                    '".mysqli_real_escape_string($link,$_POST['phone'])."',
                    '".mysqli_real_escape_string($link,$_POST['preferences'])."')";
            $resultInfo=mysqli_query($link,$insertingInfo);
            echo "1";             
        }
    }else if($type=="restaurant"){
        $existCheck="SELECT `".$relation."id` FROM `".$relation."details` WHERE `".$relation."id` = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
        $resultEC=mysqli_query($link,$existCheck);
        if($resultEC && mysqli_num_rows($resultEC)>0){
            $updatingInfo="UPDATE `".$relation."details`
                SET `name`='".mysqli_real_escape_string($link,$_POST['name'])."',
                    `phone`='".mysqli_real_escape_string($link,$_POST['phone'])."',
                    `website`='".mysqli_real_escape_string($link,$_POST['website'])."',
                    `rating`='".mysqli_real_escape_string($link,$_POST['rating'])."',
                    `image`='".mysqli_real_escape_string($link,$_FILES['restaurant_photos']['name'])."'
                WHERE `".$relation."id`='".mysqli_real_escape_string($link,$_SESSION['id'])."'";
            $resultInfo=mysqli_query($link,$updatingInfo);
            // $error.=mysqli_error($link);
            echo "1"; 
        }else{
            $insertingInfo="INSERT into `".$relation."details` (`".$relation."id`,`name`,`phone`,`website`,`rating`,`image`) 
            VALUES ('".mysqli_real_escape_string($link,$_SESSION['id'])."',
                    '".mysqli_real_escape_string($link,$_POST['name'])."',
                    '".mysqli_real_escape_string($link,$_POST['phone'])."',
                    '".mysqli_real_escape_string($link,$_POST['website'])."',
                    '".mysqli_real_escape_string($link,$_POST['rating'])."',
                    '".mysqli_real_escape_string($link,$_FILES['restaurant_photos']['name'])."')";
            $resultInfo=mysqli_query($link,$insertingInfo);
            // $error.=mysqli_error($link);
            echo "1";             
        }

        if($resultInfo && isset($_POST['name']) && isset($_FILES['restaurant_photos']['name'])){
            # Username
            $username = $_POST['name'];  
            str_replace(" ","_",$username);     
            # Get file name
            $filename = $_FILES['restaurant_photos']['name'];
            # Get File size
            $filesize = $_FILES['restaurant_photos']['size'];
            # Location
            $location = "../assets/images/restaurant/".$username;
            # create directory if not exists at location
            if(!is_dir($location)){
              mkdir($location, 0755);
            }       
            $location .= "/".$filename;      
            # Upload file
            if(move_uploaded_file($_FILES['restaurant_photos']['tmp_name'],$location)){
                echo "1";
            }
         }
    }

    // Address Geocoding :: 
    require "vendor/autoload.php";
    
    $geocoder = new \OpenCage\Geocoder\Geocoder($key);
    $result = $geocoder->geocode($_POST["line"] .','.$_POST["city"] .','.$_POST["state"].','.$_POST["pin"]);
    if ($result['total_results'] > 0) {
        $first = $result['results'][0];
        # print $first['geometry']['lng'] . ';' . $first['geometry']['lat'] . ';' .$_SESSION['id'] ."\n";
        # 4.360081;43.8316276;6 Rue Massillon, 30020 Nîmes, Frankreich

        $existAdd="SELECT `".$relation."id` FROM `".$relation."address` WHERE `".$relation."id` = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
        $resultAdd=mysqli_query($link,$existAdd);
        if($resultAdd && mysqli_num_rows($resultAdd)>0){    
            $updatingLatLng="UPDATE `".$relation."address` 
            SET `line`='".mysqli_real_escape_string($link,$_POST['line'])."',
                `city`='".mysqli_real_escape_string($link,$_POST['city'])."',
                `state`='".mysqli_real_escape_string($link,$_POST['state'])."',
                `pin`='".mysqli_real_escape_string($link,$_POST['pin'])."',
                `lat`='".mysqli_real_escape_string($link,$first['geometry']['lat'])."',
                `lng`='".mysqli_real_escape_string($link,$first['geometry']['lng'])."'
            WHERE `".$relation."id`=".$_SESSION['id'];
            $resultLatLng=mysqli_query($link,$updatingLatLng);
            echo "1"; 
        }else{
            $insertingLatLng="INSERT into `".$relation."address` (`".$relation."id`,`line`,`city`,`state`,`pin`,`lat`,`lng`) 
            VALUES ('".mysqli_real_escape_string($link,$_SESSION['id'])."',
                    '".mysqli_real_escape_string($link,$_POST['line'])."',
                    '".mysqli_real_escape_string($link,$_POST['city'])."',
                    '".mysqli_real_escape_string($link,$_POST['state'])."',
                    '".mysqli_real_escape_string($link,$_POST['pin'])."',
                    '".mysqli_real_escape_string($link,$first['geometry']['lat'])."',
                    '".mysqli_real_escape_string($link,$first['geometry']['lng'])."')";
            $resultLatLng=mysqli_query($link,$insertingLatLng);
            echo "1";          
        }
    }else{
        $error.="Couldn't Access Location Info - Please try again later ";
    }    
    if($error!=""){
        echo $error;
        exit();
    }
}