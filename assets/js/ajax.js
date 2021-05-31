//  Taking Request. Rendering response from Model. Resulting Changes in the View.

// ----------------------- Getting User Type ---------------------------------
$type = "";
$("#restaurant-welcome .overlay .icon").click(function () {
    $type = "restaurant";
    userTypeSent($type);
});

$("#customer-welcome .overlay .icon").click(function () {
    $type = "customers";
    userTypeSent($type);
});

$("#restaurant-welcome .entry-text").click(function () {
    $type = "restaurant";
    userTypeSent($type);
});
$("#customer-welcome .entry-text").click(function () {
    $type = "customers";
    userTypeSent($type);
});

// ------------------------ When Device is a Mobile .. Hover effect should be compensated by Click Effect ---------------------
// if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent)) {
//     $("#restaurant-welcome").click(function () {
//         $type = "restaurant";
//         userTypeSent($type);
//     });
//     $("#customer-welcome").click(function () {
//         $type = "customers";
//         userTypeSent($type);
//     });
// }

function userTypeSent(t) {
    $type = t;
    $.ajax({
        type: "POST",
        url: "control/actions.php?process=type",
        data: "type=" + $type,
        success: function (result) {
            if (result == 1) {
                $("#user-type").slideUp(1500, function () {
                    $("#sign-up").slideDown();
                    $("#sign-up").addClass("w3-container w3-center w3-animate-zoom");
                    $("#log-in").slideUp();
                });
            } else {
                alert(result);
            }
        }
    })
}


// ---------------------------- Signing Up Request -------------------------------
$("#sign-up-submit").click(function () {
    $.ajax({
        type: "POST",
        url: "control/actions.php?process=signup",
        data: "email=" + $("#sign-up-email").val() + "&password=" + $("#sign-up-password").val(),
        success: function (result) {
            if (result == 1) {
                if ($type == "customers") {
                    window.location.assign("index.php?page=profile");
                } else if ($type == "restaurant") {
                    window.location.assign("index.php?page=edit-profile");
                }
            } else {
                $("#sign-up .error").html(result).show();
            }
        }
    })
});

//  ------------------------------  Logging IN process Request ----------------------- 
$("#log-in-submit").click(function () {
    $.ajax({
        type: "POST",
        url: "control/actions.php?process=login",
        data: "email=" + $("#log-in-email").val() + "&password=" + $("#log-in-password").val(),
        success: function (result) {
            if (result == 1) {
                if ($type == "customers") {
                    window.location.assign("index.php?page=menu");
                } else if ($type == "restaurant") {
                    window.location.assign("index.php?page=profile");
                }
            } else {
                $("#log-in .error").html(result).show();
            }
        }
    })
});


//  -------------------------- Customer Profile Submit --------------------------------
$("#customers-profile-submit").click(function () {
    $.ajax({
        type: "POST",
        url: "control/actions.php?process=profile-setup",
        data: "name=" + $("#name").val() + "&phone=" + $("#phone").val() + "&preferences=" + $("#preferences").val() + "&line=" + $("#line").val() + "&city=" + $("#city").val() + "&state=" + $("#state").val() + "&pin=" + $("#pin").val(),
        success: function (result) {
            //    alert(result);
            if (result == "11") {
                window.location.assign("index.php?page=profile");
            } else {
                $(".customers-profile-set-up .error").html(result).show();
            }
        }
    })
});



//  -------------------------- restaurantProfile Submit -------------------------------

$("form#restaurant-profile-set-up").submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);

    $.ajax({
        url: "control/actions.php?process=profile-setup",
        type: 'POST',
        data: formData,
        success: function (result) {
            if (result == "11") {
                $(".restaurant-profile-set-up .error").html("Data Changes are Saved. File was unable to Upload!").show();                
            } else if (result == "111") {
                window.location.assign("index.php?page=profile");            
            } else {
                $(".restaurant-profile-set-up .error").html(result).show();
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}); 

// $("#restaurant-profile-submit").click(function () {
//     $.ajax({
//         type: "POST",
//         url: "control/actions.php?process=profile-setup",
//         enctype: 'multipart/form-data',
//         data: "name=" + $("#name").val() + "&phone=" + $("#phone").val() + "&website=" + $("#website").val() + "&rating=" + $("#rating").val() + "&restaurant_photos=" + $("#restaurant_photos").val() + "&line=" + $("#line").val() + "&city=" + $("#city").val() + "&state=" + $("#state").val() + "&pin=" + $("#pin").val(),
//         success: function (result) {
//             //    alert(result);
//             if (result == "11") {
//                 window.location.assign("index.php?page=profile");
//             } else {
//                 $(".restaurant-profile-set-up .error").html(result).show();
//             }
//         }
//     })
// });



