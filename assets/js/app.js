// -------------------- Loading Page ------------------------------

document.onreadystatechange = function () {
    var state = document.readyState
    if (state == 'interactive') {
         document.getElementById('load').style.visibility="visible";
    } else if (state == 'complete') {
        setTimeout(function(){
           document.getElementById('load').style.visibility="hidden";
        },1000);
    }
}

// ----------------------- Welcome Page -----------------------------

$("#sign-up-button").click(userTypeShow);
$("#log-in-button").click(userTypeShow);

function userTypeShow() {
    $("#user-type").fadeIn(1500);
}

$("#log-in-instead").click(function () {
    $("#sign-up").slideUp();
    $("#log-in").addClass("w3-container w3-center w3-animate-zoom");
    $("#log-in").slideDown();
});

$("#sign-up-instead").click(function () {
    $("#log-in").slideUp();
    $("#sign-up").slideDown();
});