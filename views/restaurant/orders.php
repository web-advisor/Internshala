

<div class="cart">
    <img src="assets/images/loading.gif" alt="Loading...">
    <h1 class="d-flex justify-content-center" style="font-weight:800;color:#209c;">Your Servings</h1>
</div>

<?php
if(isset($_SESSION['id'])){
    $rest_id=$_SESSION['id'];
    displayCart($rest_id,"");
}

?>