
//initialisation des composants pour materialize
$(".button-collapse").sideNav();


//on blanchie la barre de navigation au scroll
var backgroundNav = function () {
    let nav_barre = document.getElementById('nav_barre');

    if(window.pageYOffset > 0){
        nav_barre.setAttribute('class', nav_barre.className.replace('nav-white','nav-black'));
        // nav_barre.style.backgroundColor = 'rgba(255,255,255,0.25)';
        // nav_barre.style.color = 'rgb(20,20,20) !important';
    }else{
        nav_barre.setAttribute('class', nav_barre.className.replace('nav-black','nav-white'));
        // nav_barre.style.backgroundColor = 'rgba(255,255,255,0)';
        // nav_barre.style.color = 'rgb(255,255,255) !important';
    }
};
//changement de la couleur du fond de la nav bar au scroll
window.addEventListener('scroll', backgroundNav);


//INITIALISATION ET STYLE DES DROP DOWN DU MENU
$('.nav-dropdown').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrainWidth: false, // Does not change width of dropdown to that of the activator
        hover: true, // Activate on hover
        gutter: 0, // Spacing from edge
        belowOrigin: true, // Displays dropdown below the button
        alignment: 'left', // Displays dropdown with edge aligned to the left of button
        stopPropagation: false // Stops event propagation
    }
);
