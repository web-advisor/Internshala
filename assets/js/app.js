document.onreadystatechange = function () {
    var state = document.readyState
    if (state == 'interactive') {
         document.hide();
         document.getElementById('load').style.visibility="visible";
    } else if (state == 'complete') {
        setTimeout(function(){
           document.getElementById('load').style.visibility="hidden";
        },1000);
    }
}