<?php

// ------------------------ Fetching Rstaurant Data ---------------------------------------------

if (isset($_GET["page"]) && $_GET["page"] == "wall" && isset($_GET["rest_id"])) {
    if (isset($_GET["rest_id"])) {
        $rest_id = $_GET["rest_id"];
        $sql = "SELECT `rest_details`.*,`rest_address`.*,`restaurant`.`email` FROM `rest_details`,`rest_address`,`restaurant`
        WHERE `rest_details`.`rest_id`=" . mysqli_real_escape_string($link, $rest_id) . " AND `rest_address`.`rest_id`=" . mysqli_real_escape_string($link, $rest_id) . " AND `restaurant`.`id`=" . mysqli_real_escape_string($link, $rest_id) . "  LIMIT 1";
        $result = mysqli_query($link, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $name ??= $row['name'];
            $email ??= $row['email'];
            $phone ??= $row['phone'];
            $website ??= $row['website'];
            $rating ??= $row['rating'];
            $restaurant_photos ??= $row['image'];
            $line ??= $row['line'];
            $city ??= $row['city'];
            $state ??= $row['state'];
            $pin ??= $row['pin'];
        } else {
            $name = "";
            $phone = "";
            $line = "";
            $city = "";
            $state = "";
            $country = "";
            $pin = "";
            $rating = "";
            $website = "";
            $restaurant_photos = "";
        }
    }
}


$count = 0;

// --------------------- Fetching Data to display User Profile Data --------------------------------------------------
if (isset($_SESSION["id"]) && isset($_SESSION["type"]) && ($_GET['page'] = "profile" || $_GET['page'] = "edit-profile") ) {

    $type = $_SESSION["type"];
    $relation = substr($type, 0, 4) . "_";

    $sql = "SELECT *,`$type`.`email` FROM `" . $relation . "details`,$type
    WHERE `" . $relation . "id`=" . mysqli_real_escape_string($link, $_SESSION['id']) . " AND `" . $type . "`.`id`=" . mysqli_real_escape_string($link, $_SESSION['id']) . "  LIMIT 1";
    $result = mysqli_query($link, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // print_r($row);

        $name ??= $row['name'];
        if ($name == "name") {
            $name = "";
        } else {
            $count++;
        }

        $email ??= $row['email'];
        if ($email == "email") {
            $email = "";
        }

        $phone ??= $row['phone'];
        if ($phone == "phone") {
            $phone = "";
        } else {
            $count++;
        }

        if ($type == "customers") {
            $preferences ??= $row['preferences'];
            if ($preferences == "preferences") {
                $preferences = "";
            } else {
                $count++;
            }

            $progress = $count * 12.5;
        } else if ($type == "restaurant") {
            $website ??= $row['website'];
            if ($website == "website") {
                $website = "";
            } else {
                $count++;
            }

            $restaurant_photos ??= $row['image'];
            if ($restaurant_photos == "restaurant_photos") {
                $restaurant_photos = "";
            } else {
                $count++;
            }

            $rating ??= $row['rating'];
            if ($rating == "rating") {
                $rating = "";
            } else {
                $count++;
            }

            $progress = $count * 11.11;
            if ($progress == 99.99) {
                $progress = 100;
            }
        }
    } else {
        $name = "";
        $phone = "";
        if ($type = "customers") {
            $preferences = "";
        } else if ($type = "restaurants") {
            $rating = "";
            $website = "";
            $restaurant_photos = "";
        }
    }
}

if (isset($_SESSION["id"]) && isset($_SESSION["type"]) && ($_GET['page'] = "profile" || $_GET['page'] = "edit-profile") ) {

    $type = $_SESSION["type"];
    $relation = substr($type, 0, 4) . "_";

    $sql = "SELECT * FROM `" . $relation . "address`
        WHERE `" . $relation . "id`=" . mysqli_real_escape_string($link, $_SESSION['id']) . " LIMIT 1";
    $result = mysqli_query($link, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // print_r($row);

        $line ??= $row['line'];
        if ($line == "line") {
            $line = "";
        } else {
            $count++;
        }

        $city ??= $row['city'];
        if ($city == "city") {
            $city = "";
        } else {
            $count++;
        }

        $state ??= $row['state'];
        if ($state == "state") {
            $state = "";
        } else {
            $count++;
        }

        $pin ??= $row['pin'];
        if ($pin == "pin") {
            $pin = "";
        } else {
            $count++;
        }

        if ($type == "customers") {

            $progress = $count * 12.5;
        } else if ($type == "restaurant") {
            $progress = $count * 11.11;
            if ($progress == 99.99) {
                $progress = 100;
            }
        }
    } else {
        $name = "";
        $phone = "";
        $line = "";
        $city = "";
        $state = "";
        $country = "";
        $pin = "";
        if ($type = "customers") {
            $preferences = "";
        } else if ($type = "restaurants") {
            $rating = "";
            $website = "";
            $restaurant_photos = "";
        }
    }
}


