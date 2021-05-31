<!--  File Resposible for Profile Completion === -->

<?php
include_once("control/data.php");
?>


<form method="post" enctype="multipart/form-data" id="restaurant-profile-set-up">
<!------------------------------------------ Slideshow container ----------------------------------->
<div class="slideshow-container restaurant-profile-set-up">

    <!-- Full Name Restaurant -->
    <div class="mySlides faded" id="fullname-div">
        <div class="input-label">Hi <strong><?php if (isset($name) && $name != "") echo $name; ?></strong>,
            <br>
            Let's complete your profile, And get you Customers! Enter Restaurant's Full Name.
        </div>
        <input autocomplete="off" type="text" class="w3-input w3-animate-input profile-input" id="name" name="name" value="<?php if (isset($name) && $name != "") echo $name; ?>">
        <!-- <button class="w3-btn w3-white w3-border w3-border-red w3-text-red w3-round-large submit-button">Save</button> -->

        <div class="food-category-input" id="category">

            <div class="form-check form-check-inline radio-div">
                <input class="form-check-input radio-input" type="radio" name="rating" onclick="ratingmarker(this.value)" id="veg-option" value="vegetarian">
                <label class="form-check-label" for="veg-option">
                    <i class="fas fa-circle" id="veg"></i>
                </label>
            </div>
            <div class="form-check form-check-inline radio-div">
                <input class="form-check-input radio-input" type="radio" name="rating" onclick="ratingmarker(this.value)" id="egg-option" value="eggetarian">
                <label class="form-check-label" for="egg-option">
                    <i class="fas fa-circle" id="egg"></i>
                </label>
            </div>
            <div class="form-check form-check-inline radio-div">
                <input class="form-check-input radio-input" type="radio" name="rating" onclick="ratingmarker(this.value)" id="non-veg-option" value="non-vegetarian">
                <label class="form-check-label" for="non-veg-option">
                    <i class="fas fa-circle" id="non-veg"></i>
                </label>
            </div>

            <input autocomplete="off" type="hidden" id="rating" name="rating" value="<?php if (isset($rating) && $rating != "") echo $rating; ?>" />
        </div>
        <div class="alert alert-danger error" role="alert">
            <?php
            if (isset($error) && $error != "") {
                echo $error;
            }
            ?>
        </div>
        <div class="numbertext">1 / 4</div>
    </div>

    <div class="mySlides faded" id="phone-div">

        <div class="input-label">Hi <strong><?php if (isset($name) && $name != "") echo $name; ?></strong>,
            <br>
            <?php
            if (isset($progress) && $progress > 0) {
                echo "Let's Connect ! Contact Details here .";
            } else {
                echo "Let's start with Contact details";
            }
            ?>
        </div>
        <div class="profile-input">
            <input autocomplete="off" type="number" class="w3-input w3-animate-input" style="width:100%;" id="phone" name="phone" placeholder="Mobile Number" value="<?php if (isset($phone) && $phone != "") {
                                                                                                                                                                            echo $phone;
                                                                                                                                                                        } ?>">
            <br>
            <input autocomplete="off" type="url" class="w3-input w3-animate-input" style="width:100%;" id="website" name="website" placeholder="Website Link" value="<?php if (isset($website) && $website != "") {
                                                                                                                                                                            echo $website;
                                                                                                                                                                        } ?>">
        </div>
        <!-- <button class="w3-btn w3-white w3-border w3-border-red w3-text-red w3-round-large submit-button">Save</button> -->
        <div class="numbertext">2 / 4</div>
    </div>

    <div class="mySlides faded" id="image-div">
        <div class="input-label">Hi <strong><?php if (isset($name) && $name != "") echo $name; ?></strong>,
            <br>
            <i class="fas fa-images"></i>
            Upload Restaurant Image
        </div>

        <input autocomplete="off" type="file" class="w3-input w3-animate-input profile-input" id="restaurant_photos" name="restaurant_photos" value="<?php if (isset($restaurant_photos)) {
                                                                                                                                                            echo $restaurant_photos;
                                                                                                                                                        } ?>">

        <div class="alert alert-danger error" role="alert">
            <?php
            if (isset($error) && $error != "") {
                echo $error;
            }
            ?>
        </div>
        <div class="numbertext">3 / 4</div>
    </div>


    <div class="mySlides faded" id="address-div">
        <div class="input-label">
            <i class="centered fas fa-map-marker-alt"></i>
            Enter Restaurant Address
        </div>
        <div class="form-inline profile-input">
            <input type="text" class="form-control mb-2 mr-sm-2" name="line" id="line" placeholder="Address Line" value="<?php if (isset($line) && $line != "") {
                                                                                                                    echo $line;
                                                                                                                } ?>">
            <div class="input-group mb-2 mr-sm-2">
                <input type="text" class="form-control" name="city" id="city" placeholder="City" value="<?php if (isset($city) && $city != "") {
                                                                                                echo $city;
                                                                                            } ?>">
            </div>
            <div class="input-group mb-2 mr-sm-2">
                <input type="text" class="form-control" name="state" id="state" placeholder="State" value="<?php if (isset($state) && $state != "") {
                                                                                                    echo $state;
                                                                                                } ?>">
            </div>
            <div class="input-group mb-2 mr-sm-2">
                <input type="text" class="form-control" name="pin" id="pin" placeholder="PIN" value="<?php if (isset($pin) && $pin != "") {
                                                                                                echo $pin;
                                                                                            } ?>">
            </div>
        </div>
        <button class="w3-btn w3-white w3-border w3-border-red w3-text-red w3-round-large" id="restaurant-profile-submit">Save All Changes</button>
        <div class="alert alert-danger error" role="alert">
            <?php
            if (isset($error) && $error != "") {
                echo $error;
            }
            ?>
        </div>
        <div class="numbertext">4 / 4</div>
    </div>

    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>

</form>

<?php
if (isset($progress) && $progress > 0) { ?>
    <div class="progress">
        <div class="progress-bar progress-bar-striped bg-success" id="progress" role="progressbar" style="width:<?php echo $progress; ?>%" aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $progress; ?>%</div>
    </div>
<?php
}
?>