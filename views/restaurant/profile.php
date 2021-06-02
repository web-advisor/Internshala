<!----------------------------------  File Resposible Showing Restaurant Profile ----------------->

<?php
include_once("control/data.php");
?>


    <div class="restaurant-profile-row">
        <div class="side">
            <h2>About</h2>
            <h4>
                <?php if (isset($name) && $name != "") echo $name; 
                else echo ' Your Restaurant'; ?>
                <?php
                echo '<span style="padding-bottom:2px;">';
                if(isset($rating)){
                    if($rating=="vegetarian"){
                        echo '<i class="fas fa-circle" id="veg"></i>';
                    }else if($rating=="eggetarian"){
                        echo '<i class="fas fa-circle" id="egg"></i>';
                    }else if($rating=="non-vegetarian"){
                        echo '<i class="fas fa-circle" id="non-veg"></i>';
                    }
                } 
                echo '</span>';
            ?>
            </h4>
            <div class="restaurant-profile-image fakeimg" style="height:200px; font-size:2rem;">
                <?php if ((isset($name) && $name != "") && (isset($restaurant_photos) && $restaurant_photos != ""))
                    echo '<img src="assets/images/restaurant/' . $name . '/' . $restaurant_photos . '" alt="' . $name . '" class="restaurant-image">';
                else
                    echo '<i class="far fa-images"></i> Your Restauarant';
                ?>

            </div>
            <p style="text-align:center;font-size:1rem;">Order hot and tasty food !</p>
            <br>
            <h3>Reach Out</h3>
            <div class="fakeimg" style="height:60px;font-size:1.2rem;font-weight:600;">
                <i class="fas fa-phone-volume"></i> 
                <?php if (isset($phone) && $phone != "") echo $phone;
                else echo ' Phone'; ?>
            </div>
            <br>
            <div class="fakeimg" style="height:60px;font-size:1.2rem;font-weight:600;">
                <i class="fab fa-internet-explorer"></i> 
                <?php if (isset($website) && $website != "") echo '
                <a href="'.$website.'" style="color:#209c;text-decoration:none;">'.$website.'</a>';
                else echo ' Website'; ?> 
            </div>
            <br>
            <div class="fakeimg" style="height:60px;font-size:1.2rem;font-weight:600;">
                <i class="fas fa-envelope-square"></i> 
                <?php if (isset($email) && $email != "") echo $email;
                else echo ' Email'; ?> 
            </div>
            <br>
            <div class="fakeimg" style="height:120px;font-size:1.2rem;font-weight:600;">
                <i class="fas fa-map-marked"></i> 
                <?php if ((isset($line) && $line != "") && (isset($city) && $city != "") && (isset($state) && $state != "") && (isset($pin) && $pin!= "") ) echo "$line, <br> $city, $state,<br> $pin";
                else echo ' Address Line1,<br>City, State,<br> PIN'; ?> 
            </div>
        </div>

        <!------------------------ Menu ITems  -------------------------->
        <div class="main">
            <h2 style="color:#209c"><?php if(isset($_SESSION["type"]) && $_SESSION["type"]=="restaurant"){ ?>Your<?php } ?> Menu</h2>
            <?php 
                display("public");
            ?>
        </div>



    </div>
    <?php if(isset($_SESSION["type"]) && $_SESSION["type"]=="restaurant"){ ?>
    <a href="index.php?page=edit-profile"><img src="assets/images/settings.gif" class="settings"></a>
    <a href="index.php?page=additem"><img src="assets/images/add-item.gif" class="add-item"></a>
    <?php } ?>
