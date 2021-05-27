<?php
    include_once("control/functions.php");
    
    include_once("views/header.php");
    
    if(isset($_SESSION["id"]) && (isset($_GET["page"]) && $_GET["page"]=="profile")){
        include_once("views/profile.php");
    }else{
        include_once("views/home.php");
    }

    include_once("views/footer.php");

?>