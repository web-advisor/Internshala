<?php
    
if(isset($_GET["food_id"]) && isset($_SESSION["id"])){
    $food_id=$_GET["food_id"];
    $cust_id=$_SESSION["id"];

    displayCart($food_id,$cust_id);
    unset($_GET["food_id"]);
}

?>

<div class="cart">
    <img src="assets/images/loading.gif" alt="Loading...">
    <h1 class="d-flex justify-content-center" style="font-weight:800;color:#209c;">Your Plate</h1>
</div>

<?php
if(isset($_SESSION['id'])){
    $cust_id=$_SESSION['id'];
    displayCart("",$cust_id);
}

?>