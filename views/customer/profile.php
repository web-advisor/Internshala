<?php
include_once("control/data.php");
?>

<div class="row">
    <div class="col-md-6 order-md-3">
        <div class="container">
            <form class="customers-profile-set-up">
                <h2 class="title"><u>Profile</u></h2>
                <div class="alert alert-danger error" type="alert"></div>

                <div class="input-field">
                    <i class="centered fas fa-user"></i>
                    <input autocomplete="off" type="text" id="name" name="name" placeholder="First Name" value="<?php if (isset($name) && $name != "") echo $name; ?>" />
                </div>

                <div class="input-field">
                    <i class="centered fas fa-phone-alt"></i>
                    <input autocomplete="off" type="text" placeholder="Phone Number" id="phone" name="phone" value="<?php if (isset($phone) && $phone != "") echo $phone; ?>" />
                </div>

                <div class="input-field" id="category">
                
                    <div class="form-check form-check-inline radio-div">
                        <input class="form-check-input radio-input" type="radio" name="preferences" onclick="foodmarker(this.value)" id="veg-option" value="vegetarian">
                        <label class="form-check-label" for="veg-option">
                            <i class="fas fa-circle" id="veg"></i>
                        </label>
                    </div>
                    <div class="form-check form-check-inline radio-div">
                        <input class="form-check-input radio-input" type="radio" name="preferences" onclick="foodmarker(this.value)" id="egg-option" value="eggetarian">
                        <label class="form-check-label" for="egg-option">
                            <i class="fas fa-circle" id="egg"></i>
                        </label>
                    </div>
                    <div class="form-check form-check-inline radio-div">
                        <input class="form-check-input radio-input" type="radio" name="preferences" onclick="foodmarker(this.value)" id="non-veg-option" value="non-vegetarian">
                        <label class="form-check-label" for="non-veg-option">
                            <i class="fas fa-circle" id="non-veg"></i>
                        </label>
                    </div>
                    
                    <input autocomplete="off" type="hidden" id="preferences" value="<?php if (isset($preferences) && $preferences != "") echo $preferences; ?>" />
                </div>

                <div class="input-field">
                    <i class="centered fas fa-map-marked-alt"></i>
                    <input autocomplete="off" type="text" placeholder="line" id="line" name="line" value="<?php if (isset($line) && $line != "") echo $line; ?>" />
                </div>

                <div class="input-field">
                    <i class="centered fas fa-map-marked-alt"></i>
                    <input autocomplete="off" type="text" placeholder="City" id="city" name="city" value="<?php if (isset($city) && $city != "") echo $city; ?>" />
                </div>

                <div class="input-field">
                    <i class="centered fas fa-map-marked-alt"></i>
                    <input autocomplete="off" type="text" placeholder="State" id="state" name="state" value="<?php if (isset($state) && $state != "") echo $state; ?>" />
                </div>

                <div class="input-field">
                    <i class="centered fas fa-map-marker-alt"></i>
                    <input autocomplete="off" type="text" placeholder="Pincode" id="pin" name="pin" value="<?php if (isset($pin) && $pin != "") echo $pin; ?>" />
                </div>

                <button type="button" id="customers-profile-submit" class="btn solid">Submit</button>
            </form>
        </div>
    </div>

    <div class="col-md-6  order-md-2 position-relative">
        <img src="assets/images/customers_profile_img.svg" class="customers_profile_img" alt="I'll be there for you ('Cause you're there for me too)" />
    </div>

</div>