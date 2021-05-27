<?php
    session_start();
    require_once("hash.php");
    $link=mysqli_connect($host,$userName,$password,$dbName);
    if(mysqli_connect_error()){
        print_r(mysqli_connect_error());
           exit();
    }else{
        echo "<br>Database Connected.";
    }

    if(isset($_GET['process']) && $_GET['process']=="logout"){
            session_unset();
    }
?>