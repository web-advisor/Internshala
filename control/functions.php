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
        if($_GET["page"]=="profile"){
            $whereClause .= " AND `rest_id`='". mysqli_real_escape_string($link, $_SESSION["id"]) ."'";
        }else if($_GET["page"]=="menu"){
            $whereClause .= " AND `rest_id`!='" . mysqli_real_escape_string($link, $_SESSION["id"]) . "'";
        }
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
            if ($num_row % 1 == 0 || $num_row > 4) {
                $j = 0;
                while ($j < $num_row / 3) {
                    echo '
                        <div class="card-deck  d-flex justify-content-start">';
                    for ($i = 0; $i < 3; $i++) {
                        if (($j * 3 + $i) >= $num_row) {
                            break;
                        }
                        echo '<div class="card col-md-4">';
                        $food = "SELECT `rest_id`,`name` FROM `rest_details` WHERE `rest_id`='" . mysqli_real_escape_string($link, $row[$j * 3 + $i][1]) . "' LIMIT 1";
                        $foodresult = mysqli_query($link, $food);
                        if ($foodresult && mysqli_num_rows($foodresult) > 0) {
                            $foodrow = mysqli_fetch_assoc($foodresult);
                            $foodrestaurant = $foodrow['name'];
                            $foodrestaurantid = $foodrow['rest_id'];
                            if(isset($_SESSION["type"]) && $_SESSION["type"]=="restaurant") {
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
                            if (!(isset($_SESSION["type"]) && $_SESSION["type"]=="restaurant")) {
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

function displayHome()
{
    global $link;
    $sql = "SELECT * FROM `food` WHERE `status`='" . mysqli_real_escape_string($link, 1) . "' LIMIT 24";
    $result = mysqli_query($link, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $num_rows = mysqli_num_rows($result);
        $row = mysqli_fetch_all($result);
        if ($num_rows == 24) {
            echo '<div class="img-row">';
            $j = 0;
            while ($j < $num_rows) {
                echo '<div class="column">';
                for ($i = 0; $i < $num_rows / 4; $i++) {
                    $food = "SELECT `rest_id`,`name` FROM `rest_details` WHERE `rest_id`='" . mysqli_real_escape_string($link, $row[$j * ($num_rows / 6)  + $i][1]) . "' LIMIT 1";
                    $foodresult = mysqli_query($link, $food);
                    if ($foodresult && mysqli_num_rows($foodresult) > 0) {
                        $foodrow = mysqli_fetch_assoc($foodresult);
                        $foodrestaurant = $foodrow['name'];
                        // $foodrestaurantid = $foodrow['rest_id'];
                        echo '<img src=src="assets/images/restaurant/' . $foodrestaurant . '/' . $row[$j * ($num_rows / 6) + $i][2] . '/' . $row[$j * ($num_rows / 6)  + $i][7] . '" alt="' . $row[$j * ($num_rows / 6)  + $i][2] . '"  style="width:100%">';
                    }
                }
                $j++;
                if ($j == 6) {
                    echo '</div>';
                }
            }
            echo '</div>';
        } else {

            // -----------------  Less than 24 Results -----------------
            echo '<div class="alternate-reality">
            <div class="heading">
    Welcome to <br>
    <span style="color:#209c;">FOOD</span><span style="color:dark-grey;">SHALA

</div></div>';
        }
    } else {
        // -----------------  No  Results -----------------
        echo '<div class="alternate-reality">
        <div class="heading">
                Welcome to <br>
        <span style="color:#209c;">FOOD</span><span style="color:dark-grey;">SHALA
        </div>
    </div>';
    }
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


// .-------------------- Time Soce Order -----------------------------------
function time_since($since) {
    $chunks = array(
        array(60 * 60 * 24 * 365 , 'year'),
        array(60 * 60 * 24 * 30 , 'month'),
        array(60 * 60 * 24 * 7, 'week'),
        array(60 * 60 * 24 , 'day'),
        array(60 * 60 , 'hour'),
        array(60 , 'min'),
        array(1 , 'sec')
    );

    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        if (($count = floor($since / $seconds)) != 0) {
            break;
        }
    }

    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
    return $print;
}



function displayCart($food_id, $cust_id)
{
    global $link;
    if ($food_id == "") {
        // ------------- Displaying ----------------------------- Restaurant Info ---------------------------
        $sql = "SELECT * FROM `ordering` WHERE `cust_id`='" . mysqli_real_escape_string($link, $cust_id) . "' ORDER BY `datetime` DESC ";
        $result = mysqli_query($link, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_all($result);
            for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                $food_id = $row[$i][3];
                $rest_id = $row[$i][2];
                $rest_status = $row[$i][5];
                $quantity = $row[$i][4];

                $select = "SELECT `rest_details`.*,`rest_address`.*,`cust_address`.*,`food`.* 
                            FROM `rest_details`,`rest_address`,`cust_address`,`food`
                            WHERE `rest_details`.rest_id='" . mysqli_real_escape_string($link, $rest_id) . "'
                            AND `rest_address`.rest_id='" . mysqli_real_escape_string($link, $rest_id) . "'
                            AND `cust_address`.cust_id='" . mysqli_real_escape_string($link, $cust_id) . "'
                            AND `food`.id='" . mysqli_real_escape_string($link, $food_id) . "'";
                $selectresult = mysqli_query($link, $select);
                if ($selectresult && mysqli_num_rows($selectresult) > 0) {
                    $selectrow=mysqli_fetch_all($selectresult);

                    echo '<div class="container cart-item">';
                        for($j=0;$j<mysqli_num_rows($selectresult);$j++){
                            echo '<div class="row mx-auto">';
                                echo '<div class="col-md-4 mx-auto  d-flex justify-content-center">';
                                    echo '<img id="cart-view" height="300px" src="assets/images/restaurant/' . $selectrow[$j][2] . '/' . $selectrow[$j][25] . '/' . $selectrow[$j][30] . '" alt="' . $selectrow[$j][25] . '">';
                                echo '</div>';
                                echo '<div class="col-md-8 mx-auto">';
                                    echo '<h2>'.$selectrow[$j][25].'</h2>';
                                    echo '<h4 style="font-weight:800;"><i class="fas fa-rupee-sign"></i> '.$selectrow[$j][31].'<span style="font-weight:600;color:#209c;">  &middot;  Order '.$rest_status.'</span>  &middot;  <span style="font-weight:600;color:brown;">Quantity : '.$quantity.'</span></h4>';
                                    echo '<div class="row">';
                                        echo '<div class="col-md-6">';
                                            echo '<h4 style="color:#209c;font-weight:800;">From :</h4>';
                                            echo '<h5>'.$selectrow[$j][2].',<br>'.$selectrow[$j][9].',<br>'.$selectrow[$j][10].','.$selectrow[$j][11].',<br>'.$selectrow[$j][12].'</h5>';
                                        echo '</div>';
                                        echo '<div class="col-md-6">';
                                            echo '<h4 style="color:#209c;font-weight:800;">To :</h4>';
                                            echo '<h5>'.$selectrow[$j][17].',<br>'.$selectrow[$j][18].','.$selectrow[$j][19].',<br>'.$selectrow[$j][20].'</h5>';
                                            echo '<p>'.time_since(time()-strtotime($row[$i][6])-7200).' ago</p>';
                                            // echo '<button type="button" class="food-bg btn" id="customer-reeceived">Mark as Received</button>';

                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        }
                    echo '</div>';

                }
            }
        } else {
            echo '<h3 class="d-flex justify-content-center">Your Plate is Empty</h3>';
        }
    } else if ($cust_id == "") {
        // ------------- Displaying ----------------------------- Customer Info ---------------------------
        $rest_id=$food_id;
        $sql = "SELECT * FROM `ordering` WHERE `rest_id`='" . mysqli_real_escape_string($link, $rest_id) . "' ORDER BY `datetime` DESC ";
        $result = mysqli_query($link, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_all($result);
            for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                $food_id = $row[$i][3];
                $rest_id = $row[$i][2];
                $cust_id = $row[$i][1];
                $rest_status = $row[$i][5];
                $quantity = $row[$i][4];

                $select = "SELECT `cust_details`.*,`cust_address`.*,`food`.* 
                            FROM `cust_details`,`cust_address`,`food`
                            WHERE `cust_details`.cust_id='" . mysqli_real_escape_string($link, $cust_id) . "'
                            AND `cust_address`.cust_id='" . mysqli_real_escape_string($link, $cust_id) . "'
                            AND `food`.id='" . mysqli_real_escape_string($link, $food_id) . "'";
                $selectresult = mysqli_query($link, $select);
                if ($selectresult && mysqli_num_rows($selectresult) > 0) {
                    $selectrow=mysqli_fetch_all($selectresult);
                    // echo '<pre>';
                    // var_dump($selectrow);
                    // echo '</pre>';

                    echo '<div class="container order-item">';
                        for($j=0;$j<mysqli_num_rows($selectresult);$j++){
                            echo '<div class="row mx-auto">';
                                echo '<div class="col-md-4 mx-auto ">';
                                    echo '<h4 style="color:#209c;font-weight:800;">Order :</h4>';
                                    echo '<h5>'.$selectrow[$j][15].'</h5>';
                                    echo '<h5>Quantity : '.$quantity.'</h5>';
                                    echo '<p>'.time_since(time()-strtotime($row[$i][6])-7200).' ago</p>';
                                echo '</div>';
                                echo '<div class="col-md-4 mx-auto">';
                                    echo '<h4 style="color:#209c;font-weight:800;">Name :</h4>';
                                    echo '<h5>'.$selectrow[$j][2].'</h5>';
                                    echo '<h4 style="color:#209c;font-weight:800;">Phone :</h4>';
                                    echo '<h5>'.$selectrow[$j][3].'</h5>';
                                echo '</div>';
                                echo '<div class="col-md-4 mx-auto">';       
                                    echo '<h4 style="color:#209c;font-weight:800;">Address :</h4>';
                                    echo '<h5>'.$selectrow[$j][7].',<br>'.$selectrow[$j][8].','.$selectrow[$j][9].',<br>'.$selectrow[$j][10].'</h5>';
                                    // echo '<button type="button" class="food-bg btn" id="restaurant-ready">Mark as Out for Delvivery</button>';
                                echo '</div>';
                            echo '</div>';
                        }
                    echo '</div>';

                }
            }
        } else {
            echo 'Your Plate is Empty';
        }
    } else {
        $sql = "SELECT * FROM `ordering` WHERE `food_id`='" . mysqli_real_escape_string($link, $food_id) . "' AND `cust_id`='" . mysqli_real_escape_string($link, $cust_id) . "' LIMIT 1";
        $result = mysqli_query($link, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            // ---------- One Order Already Qty Increase -------------
            $row = mysqli_fetch_assoc($result);
            $qty = $row["cust_status"];
            $qty++;
            $update = "UPDATE `ordering` SET `cust_status`='" . mysqli_real_escape_string($link, $qty) . "'
            WHERE `food_id`='" . mysqli_real_escape_string($link, $food_id) . "' AND `cust_id`='" . mysqli_real_escape_string($link, $cust_id) . "' LIMIT 1";
            mysqli_query($link, $update);
            // header('Location:index.php?page=cart');
        } else {
            // ------------------------------------------- New cart Entry ------------------------------------------------
            $food = "SELECT `rest_id` FROM `food` WHERE `id`='" . mysqli_real_escape_string($link, $food_id) . "' LIMIT 1";
            $foodresult = mysqli_query($link, $food);
            if ($foodresult && mysqli_num_rows($foodresult) > 0) {
                $row = mysqli_fetch_assoc($foodresult);
                $rest_id = $row["rest_id"];
                $insert = "INSERT INTO `ordering`
            (`cust_id`,`rest_id`,`food_id`,`cust_status`,`rest_status`,`datetime`) 
        VALUES (
                '" . mysqli_real_escape_string($link, $cust_id) . "',
                '" . mysqli_real_escape_string($link, $rest_id) . "',
                '" . mysqli_real_escape_string($link, $food_id) . "',
                '" . mysqli_real_escape_string($link, "1") . "',
                '" . mysqli_real_escape_string($link, "Received") . "',NOW()) ";
                $insertresult = mysqli_query($link, $insert);
                echo mysqli_error($link);
            }
        }
    }
}


