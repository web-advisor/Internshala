<!----------------------------------  File Resposible Showing Restaurant Profile ----------------->

<?php
include_once("control/data.php");
?>

<?php if (isset($progress) && $progress >= 50) {        ?>

    <div class="restaurant-profile-row">
        <div class="side">
            <h2>About</h2>
            <h4>
                <?php if (isset($name) && $name != "") echo $name;
                else echo ' Your Restaurant'; ?>
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
        <div class="main">
            <h2 style="color:#209c">Your Menu</h2>
            <?php
                    
            ?>
            <div class="fakeimg" style="height:200px;font-size:2rem;"><i class="far fa-images"></i> Your Menu</div>

            <p>Description</p>
            <br>

            <h2>TITLE HEADING</h2>
            <h5>Title description, Sep 2, 2017</h5>
            <div class="fakeimg" style="height:200px;">Image</div>
            <p>Some text..</p>
            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
        </div>
    </div>
    <a href="index.php?page=edit-profile"><img src="assets/images/settings.gif" class="settings"></a>
    <a href="index.php?page=additem"><img src="assets/images/add-item.gif" class="add-item"></a>

<?php } else {    ?>

    <div class="img-row">
        <div class="side">
            <h2>About</h2>
            <h4>Your Restauarant</h4>
            <div class="fakeimg" style="height:200px; font-size:2rem;">
                <i class="far fa-images"></i> Your Restauarant
            </div>
            <p>Order hot and tasty food !</p>
            <h3>Reach Out</h3>
            <div class="fakeimg" style="height:60px;font-size:1.5rem;"><i class="fas fa-phone-volume"></i> Phone </div><br>
            <div class="fakeimg" style="height:60px;font-size:1.5rem;"><i class="fab fa-internet-explorer"></i> Website</div><br>
            <div class="fakeimg" style="height:60px;font-size:1.5rem;"><i class="fas fa-envelope-square"></i> Email</div><br>
            <div class="fakeimg" style="height:120px;font-size:1.5rem;"><i class="fas fa-map-marked"></i> Address</div>
        </div>
        <div class="main">
            <h2>Your Menu</h2>
            <div class="fakeimg" style="height:200px;font-size:2rem;"><i class="far fa-images"></i> Your Menu</div>

            <p>Description</p>
            <br>
        </div>
    </div>

<?php } ?>