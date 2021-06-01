<?php
session_start();
require_once("hash.php");
$link = mysqli_connect($host, $userName, $password, $dbName);
if (mysqli_connect_error()) {
    print_r(mysqli_connect_error());
    exit();
}

if (isset($_GET['process']) && $_GET['process'] == "logout") {
    session_unset();
}

// -------------------------------------------------------- Displaying Food cards - For Menu@Restaurant, Search Results -----------------------------------------------------------------------------------------------------
function displayFoodCards($type, $rating)
{
    $whereClause = "";
    global $link;

    if ($type == "chef-special") {
        $whereClause = "WHERE `status`='" . mysqli_real_escape_string($link, 1) . "' AND `rating`='" . mysqli_real_escape_string($link, $rating) . "'";
    } else if ($type == "Breakfast" || $type == "Lunch" || $type == "Dinner" || $type == "Snacks" || $type == "Bevarages") {
        $whereClause = "WHERE `category`='" . mysqli_real_escape_string($link, $type) . "' AND `rating`='" . mysqli_real_escape_string($link, $rating) . "'";
    }
    if (isset($_SESSION['type']) && $_SESSION["type"] == "restaurant") {
        $whereClause .= " AND `rest_id`='" . mysqli_real_escape_string($link, $_SESSION["id"]) . "'";
    }
    if (isset($_GET["rest_id"]) && isset($_SESSION['type']) && $_SESSION["type"] == "customers") {
        $whereClause .= " AND `rest_id`='" . mysqli_real_escape_string($link, $_GET['rest_id']) . "'";
    }
    if ($whereClause != "") {
        $query = "SELECT * FROM `food` " . $whereClause . " LIMIT 9";

        $result = mysqli_query($link, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $num_row = mysqli_num_rows($result);
            $row = mysqli_fetch_all($result);
            echo '<div class="container food-card-display">';
            if ($type == "chef-special") {
                echo '<p class="h2">Chef Special</p>';
            } else {
                echo '<p class="h2">' . $type . '</p>';
            }
            if ($rating == "vegetarian") {
                echo '<p class="h3 text-success">Vegetarian</p>';
            } else if ($rating == "eggetarian") {
                echo '<p class="h3 text-warning">Eggetarian</p>';
            } else if ($rating == "non-vegetarian") {
                echo '<p class="h3 text-danger">Non-Vegetarian</p>';
            }
            if ($num_row % 3 == 0) {
                $j = 0;
                while ($j < $num_row / 3) {
                    echo '
                        <div class="card-deck">';
                    for ($i = 0; $i < 3; $i++) {
                        echo '<div class="card col-md-4">';
                        $food = "SELECT `rest_id`,`name` FROM `rest_details` WHERE `rest_id`='" . mysqli_real_escape_string($link, $row[$j * 3 + $i][1]) . "' LIMIT 1";
                        $foodresult = mysqli_query($link, $food);
                        if ($foodresult && mysqli_num_rows($foodresult) > 0) {
                            $foodrow = mysqli_fetch_assoc($foodresult);
                            $foodrestaurant = $foodrow['name'];
                            $foodrestaurantid = $foodrow['rest_id'];
                            if ((isset($_SESSION["type"]) && $_SESSION['type'] == "restaurant")) {
                                echo '<div class="card-header position-relative">
                                        <a href="index.php?page=additem&food_id=' . $row[$j * 3 + $i][0] . '" title="Edit Info"><img src="assets/images/settings.gif" class="settings"></a>
                                        <a href="#" style="color:#209c;text-decoration:none;" title="Edit Info"><i class="fas fa-minus-circle" id="delete-food-item"><input type="hidden" value="' . $row[$j * 3 + $i][0] . '"></i></a> 
                                    </div>';
                            }
                            echo '<img class="card-img-top" height="200px" src="assets/images/restaurant/' . $foodrestaurant . '/' . $row[$j * 3 + $i][2] . '/' . $row[$j * 3 + $i][7] . '" alt="' . $row[$j * 3 + $i][2] . '">
                                    <div class="card-body">
                                        <h5 class="card-title">' . $row[$j * 3 + $i][2] . '</h5>
                                        <p class="card-text">' . $row[$j * 3 + $i][6] . '</p>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"> <i class="fas fa-rupee-sign"></i> ' . $row[$j * 3 + $i][8] . '</li>
                                        </ul>';
                            if (!(isset($_SESSION["type"]) && $_SESSION['type'] == "restaurant")) {
                                if (isset($_SESSION['id']) && isset($_SESSION['type']) && $_SESSION['type'] == "customers") {
                                    echo '<a href="index.php?page=cart&food_id=' . $row[$j * 3 + $i][0] . '" class="btn food-bg">ORDER</a>';
                                } else {
                                    $_SESSION['type'] = "customers";
                                    echo '<a href="#" id="login-required" class="btn food-bg">ORDER</a>';
                                }
                            }
                            echo ' </div>';
                            if (!(isset($_SESSION["type"]) && $_SESSION['type'] == "restaurant")) {
                                echo '<div class="card-footer">
                                            <small class="text-muted"><a href="index.php?page=wall&rest_id=' . $foodrestaurantid . '" style="color:#209c;text-decoration:none;">' . $foodrestaurant . '</a></small>
                                        </div>';
                            }
                        }
                        echo '</div>';
                    }
                    echo '</div>';
                    $j++;
                }
            } else if ($num_row % 2 == 0) {
                //  2 results Each Row
                $j = 0;
                while ($j < $num_row / 2) {
                    echo '
                        <div class="card-deck">';
                    for ($i = 0; $i < 2; $i++) {
                        echo '<div class="card col-md-6">';

                        $food = "SELECT `rest_id`,`name` FROM `rest_details` WHERE `rest_id`='" . mysqli_real_escape_string($link, $row[$j * 2 + $i][1]) . "' LIMIT 1";
                        $foodresult = mysqli_query($link, $food);
                        if ($foodresult && mysqli_num_rows($foodresult) > 0) {
                            $foodrow = mysqli_fetch_assoc($foodresult);
                            $foodrestaurant = $foodrow['name'];
                            $foodrestaurantid = $foodrow['rest_id'];
                            if ((isset($_SESSION["type"]) && $_SESSION['type'] == "restaurant")) {
                                echo '<div class="card-header position-relative">
                                        <a href="index.php?page=additem&food_id=' . $row[$j * 2 + $i][0] . '"><img src="assets/images/settings.gif" class="settings"></a>
                                        <a href="#" style="color:#209c;text-decoration:none;"><i class="fas fa-minus-circle" id="delete-food-item"><input type="hidden" value="' . $row[$j * 2 + $i][0] . '"></i></a> 
                                    </div>';
                            }
                            echo '<img class="card-img-top" height="300px" src="assets/images/restaurant/' . $foodrestaurant . '/' . $row[$j * 2 + $i][2] . '/' . $row[$j * 2 + $i][7] . '" alt="' . $row[$j * 2 + $i][2] . '">
                                    <div class="card-body">
                                        <h5 class="card-title">' . $row[$j * 2 + $i][2] . '</h5>
                                        <p class="card-text">' . $row[$j * 2 + $i][6] . '</p>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"> <i class="fas fa-rupee-sign"></i> ' . $row[$j * 2 + $i][8] . '</li>
                                        </ul>';
                            if (!(isset($_SESSION["type"]) && $_SESSION['type'] == "restaurant")) {
                                if (isset($_SESSION['id']) && isset($_SESSION['type']) && $_SESSION['type'] == "customers") {
                                    echo '<a href="index.php?page=cart&food_id=' . $row[$j * 2 + $i][0] . '" class="btn food-bg">ORDER</a>';
                                } else {
                                    $_SESSION['type'] = "customers";
                                    echo '<a href="#" id="login-required" class="btn food-bg">ORDER</a>';
                                }
                            }
                            echo ' </div>';
                            if (!(isset($_SESSION["type"]) && $_SESSION['type'] == "restaurant")) {
                                echo '<div class="card-footer">
                                            <small class="text-muted"><a href="index.php?page=wall&rest_id=' . $foodrestaurantid . '" style="color:#209c;text-decoration:none;">' . $foodrestaurant . '</a></small>
                                        </div>';
                            }
                        }
                        echo '</div>';
                    }
                    echo '</div>';
                    $j++;
                }
            } else if ($num_row % 1 == 0) {
                //  2 results Each Row
                $j = 0;
                while ($j < $num_row / 1) {
                    echo '
                        <div class="card-deck">';
                    for ($i = 0; $i < 1; $i++) {
                        echo '<div class="card col-md-12">';

                        $food = "SELECT `rest_id`,`name` FROM `rest_details` WHERE `rest_id`='" . mysqli_real_escape_string($link, $row[$j * 2 + $i][1]) . "' LIMIT 1";
                        $foodresult = mysqli_query($link, $food);
                        if ($foodresult && mysqli_num_rows($foodresult) > 0) {
                            $foodrow = mysqli_fetch_assoc($foodresult);
                            $foodrestaurant = $foodrow['name'];
                            $foodrestaurantid = $foodrow['rest_id'];
                            if ((isset($_SESSION["type"]) && $_SESSION['type'] == "restaurant")) {
                                echo '<div class="card-header position-relative">
                                        <a href="index.php?page=additem&food_id=' . $row[$j + $i][0] . '"><img src="assets/images/settings.gif" class="settings"></a>
                                        <a href="#" style="color:#209c;text-decoration:none;"><i class="fas fa-minus-circle" id="delete-food-item"><input type="hidden" value="' . $row[$j + $i][0] . '"></i></a> 
                                    </div>';
                            }
                            echo '<img class="card-img-top" height="500px" src="assets/images/restaurant/' . $foodrestaurant . '/' . $row[$j + $i][2] . '/' . $row[$j + $i][7] . '" alt="' . $row[$j + $i][2] . '">
                                    <div class="card-body">
                                        <h5 class="card-title">' . $row[$j + $i][2] . '</h5>
                                        <p class="card-text">' . $row[$j + $i][6] . '</p>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"> <i class="fas fa-rupee-sign"></i> ' . $row[$j + $i][8] . '</li>
                                        </ul>';
                            if (!(isset($_SESSION["type"]) && $_SESSION['type'] == "restaurant")) {
                                if (isset($_SESSION['id']) && isset($_SESSION['type']) && $_SESSION['type'] == "customers") {
                                    echo '<a href="index.php?page=cart&food_id=' . $row[$j + $i][0] . '" class="btn food-bg">ORDER</a>';
                                } else {
                                    $_SESSION['type'] = "customers";
                                    echo '<a href="#" id="login-required" class="btn food-bg">ORDER</a>';
                                }
                            }
                            echo ' </div>';
                            if (!(isset($_SESSION["type"]) && $_SESSION['type'] == "restaurant")) {
                                echo '<div class="card-footer">
                                            <small class="text-muted"><a href="index.php?page=wall&rest_id=' . $foodrestaurantid . '" style="color:#209c;text-decoration:none;">' . $foodrestaurant . '</a></small>
                                        </div>';
                            }
                        }
                        echo '</div>';
                    }
                    echo '</div>';
                    $j++;
                }
            }
            echo '</div>';
        } else {
            //  No Results Yet
        }
    } else {
        //  WhereClause Empty
    }
}

// ------------- Displaying Restaurant Location Results --------Search Page initiation Required---------- 
function displayRestaurants($lat, $lng)
{
    global $link;
}

function display($type)
{
    displayFoodCards("chef-special", "vegetarian");
    displayFoodCards("chef-special", "eggetarian");
    displayFoodCards("chef-special", "non-vegetarian");
    displayFoodCards("Breakfast", "vegetarian");
    displayFoodCards("Breakfast", "eggetarian");
    displayFoodCards("Breakfast", "non-vegetarian");
    displayFoodCards("Lunch", "vegetarian");
    displayFoodCards("Lunch", "eggetarian");
    displayFoodCards("Lunch", "non-vegetarian");
    displayFoodCards("Dinner", "vegetarian");
    displayFoodCards("Dinner", "eggetarian");
    displayFoodCards("Dinner", "non-vegetarian");
    displayFoodCards("Snacks", "vegetarian");
    displayFoodCards("Snacks", "eggetarian");
    displayFoodCards("Snacks", "non-vegetarian");
    displayFoodCards("Beverages", "vegetarian");
    displayFoodCards("Beverages", "eggetarian");
    displayFoodCards("Beverages", "non-vegetarian");
}
