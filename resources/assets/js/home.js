var reverser = false;

(function(){
    reverseSmartphone();
})();

window.onresize = function () {reverseSmartphone();}

function reverseSmartphone() {
    let body = document.getElementsByTagName('body')[0];

    //si l'écran est sur smarthone et que les div sont dans leur ordre originel
    if(body.offsetWidth < 600 && reverser == false) {
        reverseDiv();
        reverser = true;
    }

    if(body.offsetWidth >= 600 && reverser == true) {
        reverseDiv();
        reverser = false;
    }

}

function reverseDiv() {
    let reverseSmartphoneDiv = document.getElementsByClassName('reverse-smartphone');

    for(let iDiv in reverseSmartphoneDiv){

        let div_reverse = reverseSmartphoneDiv[iDiv];
        let div_1 = div_reverse.getElementsByClassName('order-1')[0],
            div_2 = div_reverse.getElementsByClassName('order-2')[0],
            temp = div_1.innerHTML;

        div_1.innerHTML = div_2.innerHTML;
        div_2.innerHTML = temp;
    }
}