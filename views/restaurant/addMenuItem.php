<?php
include_once("control/data.php");
?>


<div class="food-item-set-up">
    <form method="POST" enctype="multipart/form-data" id="food-item-add">
        <div class="form-group">
            <label for="food_name">Dish Name</label>
            <input type="text" class="form-control" id="food_name" name="food_name" value="<?php if (isset($food_name) && $food_name != "") echo $food_name; ?>">
        </div>

        <div class="form-group">
            <label for="food_type">Dish Type</label>
            <select class="form-control" id="food_type" name="food_type" value="<?php if (isset($food_type) && $food_type != "") echo $food_type; ?>">
                <option></option>
                <option>Breakfast</option>
                <option>Lunch</option>
                <option>Dinner</option>
                <option>Snacks</option>
                <option>Bevarages</option>
            </select>
        </div>

        <div class="food-category-input-food-form" id="category">

            <div class="form-check form-check-inline radio-div">
                <input class="form-check-input radio-input" type="radio" name="foodrating" onclick="foodratingmarker(this.value)" id="veg-option" value="vegetarian">
                <label class="form-check-label" for="veg-option">
                    <i class="fas fa-circle" id="veg"></i>
                </label>
            </div>
            <div class="form-check form-check-inline radio-div">
                <input class="form-check-input radio-input" type="radio" name="foodrating" onclick="foodratingmarker(this.value)" id="egg-option" value="eggetarian">
                <label class="form-check-label" for="egg-option">
                    <i class="fas fa-circle" id="egg"></i>
                </label>
            </div>
            <div class="form-check form-check-inline radio-div">
                <input class="form-check-input radio-input" type="radio" name="foodrating" onclick="foodratingmarker(this.value)" id="non-veg-option" value="non-vegetarian">
                <label class="form-check-label" for="non-veg-option">
                    <i class="fas fa-circle" id="non-veg"></i>
                </label>
            </div>

            <input autocomplete="off" type="hidden" id="foodrating" name="foodrating" value="<?php if (isset($foodrating) && $foodrating != "") echo $foodrating; ?>" />
        </div>
        <div class="form-outline">
            <label class="form-label" for="food_keywords">Keywords</label>
            <textarea class="form-control" id="food_keywords" name="food_keywords" rows="1" data-bs-toggle="tooltip" data-bs-placement="top" title="Adding Keywords to the increases your reach !"><?php if (isset($food_keywords) && $food_keywords != "") echo $food_keywords; ?></textarea>
        </div>
        <div class="form-group shadow-textarea">
            <label for="food_description">Description</label>
            <textarea class="form-control z-depth-1" id="food_description" name="food_description" rows="3" placeholder="Write Dish Description here..."><?php if (isset($food_description) && $food_description != "") echo $food_description; ?></textarea>
        </div>
        <div class="form-group">
            <label for="food_photo">Photo</label>
            <input autocomplete="off" type="file" class="form-control" id="food_photo" name="food_photo" value="<?php if (isset($food_photo)) {
                                                                                                                    echo $food_photo;
                                                                                                                } ?>">
        </div>

        <div class="form-group">
            <label for="food_price">Dish Price</label>
            <input type="number" class="form-control" id="food_price" name="food_price" value="<?php if (isset($food_price) && $food_price != "") echo $food_price; ?>">
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="status" name="status">
            <label class="custom-control-label" for="status"  data-bs-toggle="tooltip" data-bs-placement="top" title="Chef Special Dishes gets featured on our Web App Wall !" >Declare this Dish Chef Special ?</label>
        </div>
        <button type="submit" class="btn btn-lg btn-block food-bg" id="food_data_submit">Submit</button>
    </form>

    <div class="alert alert-danger error" role="alert">
        <?php
        if (isset($error) && $error != "") {
            echo $error;
        }
        ?>
    </div>

</div>