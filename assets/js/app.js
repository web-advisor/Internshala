// -------------------- Loading Page ------------------------------

document.onreadystatechange = function () {
    var state = document.readyState
    if (state == 'interactive') {
        document.getElementById('load').style.visibility = "visible";
    } else if (state == 'complete') {
        setTimeout(function () {
            document.getElementById('load').style.visibility = "hidden";
        }, 1000);
    }
}

// ----------------------- Welcome Page -----------------------------

$("#sign-up-button").click(userTypeShow);

function userTypeShow() {
    $("#sign-up").slideUp();
    $("#log-in").slideUp();
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

// ---------------------------Profile Set Up -- Food Mark ----------------------
function foodmarker(foodmark) {
    document.getElementById("preferences").value = foodmark; 
}
function ratingmarker(ratingmark) {
    document.getElementById("rating").value = ratingmark; 
}


// ------------------------ Tooltip Function Call ---------------------- 
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
})

//  ------------------------------------------ SlideShow --------------------------
var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  slides[slideIndex-1].style.display = "block";
}
