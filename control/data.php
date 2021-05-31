<?php


// --------------------- Fetching Data to display User Profile Data --------------------------------------------------
if(isset($_SESSION["id"]) && isset($_SESSION["type"]) && ($_GET['page']="profile" || $_GET['page']="edit-profile")){

$type=$_SESSION["type"];
$relation=substr($type,0,4)."_";

$sql = "SELECT * FROM `".$relation."details`,`".$relation."address` 
    WHERE `".$relation."details`.`".$relation."id`=" . mysqli_real_escape_string($link,$_SESSION['id']) . " AND `".$relation."address`.`".$relation."id`=" . mysqli_real_escape_string($link,$_SESSION['id']). " LIMIT 1";
$result = mysqli_query($link, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    // print_r($row);
    $count=0;
    
    $name ??= $row['name'];
    if ($name == "name") {
        $name = "";
    }else{
        $count++;
    }

    $phone ??= $row['phone'];
    if ($phone == "phone") {
        $phone = "";
    }else{
        $count++;
    }

    $line ??= $row['line'];
    if ($line == "line") {
        $line = "";
    }else{
        $count++;
    }

    $city ??= $row['city'];
    if ($city == "city") {
        $city = "";
    }else{
        $count++;
    }

    $state ??= $row['state'];
    if ($state == "state") {
        $state = "";
    }else{
        $count++;
    }

    $pin ??= $row['pin'];
    if ($pin == "pin") {
        $pin = "";
    }else{
        $count++;
    }

    if($type=="customers"){
        $preferences ??= $row['preferences'];
        if ($preferences == "preferences") {
            $preferences = "";
        }else{
            $count++;
        }

        $progress=$count*12.5;

    }else if($type=="restaurant"){
        $website ??= $row['website'];
        if ($website == "website") {
            $website = "";
        }else{
            $count++;
        }

        $restaurant_photos ??= $row['image'];
        if ($restaurant_photos == "restaurant_photos") {
            $restaurant_photos = "";
        }else{
            $count++;
        }

        $rating ??= $row['rating'];
        if ($rating == "rating") {
            $rating = "";
        }else{
            $count++;
        }

        $progress=$count*11.11;
        if($progress==99.99){
            $progress=100;
        }
    }



}else{
    $name="";
    $phone="";
    $line="";
    $city="";
    $state="";
    $country="";
    $pin="";
    if($type="customers"){
        $preferences = "";
    }else if($type="restaurants"){
        $rating = "";
        $website = "";
        $restaurant_photos = "";
    }
}



}
