<?php
include_once("control/functions.php");

include_once("views/header.php");

if (isset($_GET["page"]) && $_GET["page"] == "menu") {
    include_once("views/menu.php");
} else if (isset($_SESSION["id"]) && (isset($_GET["page"]) && $_GET["page"] == "edit-profile")) {
    include_once("views/restaurant/edit-profile.php");
} else if (isset($_SESSION["id"]) && (isset($_GET["page"]) && $_GET["page"] == "profile")) {
    if (isset($_SESSION["type"]) && $_SESSION["type"] == "customers") {
        include_once("views/customer/profile.php");
    } else if (isset($_SESSION["type"]) && $_SESSION["type"] == "restaurant") {
        include_once("views/restaurant/profile.php");
    }
} else if (isset($_SESSION["id"]) && (isset($_GET["page"]) && $_GET["page"] == "cart") && (isset($_SESSION["type"]) && $_SESSION["type"] == "customers")) {
    include_once("views/customer/cart.php");
} else if (isset($_SESSION["id"]) && (isset($_GET["page"]) && $_GET["page"] == "order") && (isset($_SESSION["type"]) && $_SESSION["type"] == "restaurant")) {
    include_once("views/restaurant/order.php");
} else if (isset($_SESSION["id"]) && (isset($_GET["page"]) && $_GET["page"] == "additem") && (isset($_SESSION["type"]) && $_SESSION["type"] == "restaurant")) {
    include_once("views/restaurant/addMenuItem.php");
} else {
    include_once("views/home.php");
}

include_once("views/footer.php");
