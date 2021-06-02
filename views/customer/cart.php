<?php
    
if(isset($_GET["food_id"]) && isset($_SESSION["id"])){
    $food_id=$_GET["food_id"];
    $cust_id=$_SESSION["id"];
    $sql="SELECT * FROM `ordering` WHERE `food_id`='".mysqli_real_escape_string($link,$food_id)."' AND `cust_id`='".mysqli_real_escape_string($link,$cust_id)."' LIMIT 1";
    $result=mysqli_query($link,$query);
    if($result && mysqli_num_rows($result)>0){
        // ---------- One Order Alreafy Qty Increase -------------
        
    }
    
}




?>