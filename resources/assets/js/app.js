var sMDE,
    ajaxSubmited = false;

//initialisation des composants pour materialize
$(".button-collapse").sideNav();
$('.modal').modal();

//on blanchie la barre de navigation au scroll
var backgroundNav = function () {
    let nav_barre = document.getElementById('nav_barre');

    if(window.pageYOffset > 0){
        nav_barre.setAttribute('class', nav_barre.className.replace('nav-white','nav-black'));
    }else{
        nav_barre.setAttribute('class', nav_barre.className.replace('nav-black','nav-white'));
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


//FONCTION D'OUVERUTRE DES MODALES PERMETTANTS L'ÉDITION DU CONTENUE DES TABLES
function openModal(route, data) {

    let loadModal = document.getElementById('load-modal'),
        contentModal = document.getElementById('modal-content');

    //on montre le loader et cache le contenu
    loadModal.style.display = 'block';
    contentModal.style.display = 'none';

    //on change les ' par des " pour pouvoir parser en JSON
    data = JSON.parse(data.replace(/[']/g,'"'));

    //requête ajax
    axios.post(route, data).then(function (response) {

        contentModal.innerHTML = response.data;

        //lie des actions particulière à la modal
        specialAction();

        //on cache le loader et on montre le contenu
        loadModal.style.display = 'none';
        contentModal.style.display = 'block';
    });
}

//FUNCTION D'AJOUT D'ACTION SPÉCIAL
function specialAction() {

    //si nous avons un input du type lien de la page courante
    let inputCurrentPage = document.getElementById('inputCurrentPage');
    try {
        inputCurrentPage.value = location.href;
    }catch (e){}
}

//ACCROCHE LES ÉVÉNEMENTS ONCLICK POUR L'OUVERTURE DES MODALES
window.onload = function () {
  let btnModal = document.getElementsByClassName('btnModal');

  for(let i = 0 ; i < btnModal.length ; i++){

      let route = btnModal[i].getAttribute('data-route'),
          data = btnModal[i].getAttribute('data-modal');

      btnModal[i].addEventListener('click', function() {openModal(route, data);});
  }
};



//CETTE FONCTION GÉRE LE SUBMIT DES DONNÉES EN AJAX
function submitData(form, callback) {
    let inputData = form.getElementsByClassName('input-data'),
        method = document.getElementById('_method').value,
        route = form.getAttribute('data-route'),
        errorPopupText = document.getElementById('errorPopupText'),
        data = {};

    //Si nous ne somme pas déjà entrain de soumettre un formulaire
    if(!ajaxSubmited){

        ajaxSubmited = true;
        showSubmitLoader(true);

        //on cache le message d'erreur
        errorPopupText.style.display = 'none';

        //on affiche un loader à la place du bouton submit

        //créer un talbeau JSON des données à passer en paramètre
        for(let i in inputData){
            if(typeof inputData[i].value != "undefined") data[inputData[i].name] = inputData[i].value;
        }

        //lance la fonction ajax
        axios(
            {
                method : method,
                url : route,
                data : data
            }
        ).then(function (response) {

            //on renseigne comme quoi nous ne somme plus entrain de soumettre un forumlaire
            ajaxSubmited = false;

            //appel du callback avec les datas de réponse
            callback(response);

        }).catch(function (error) {

            //on renseigne comme quoi nous ne somme plus entrain de soumettre un forumlaire
            ajaxSubmited = false;
            showSubmitLoader(false);

            //table des erreurs
            let errorArray = [];

            //on boucle sur les erreurs renvoyées
            for(let detailError in error.response.data){

                //on ajout au tableau l'erreur courante
                errorArray.push(error.response.data[detailError]);

                //on ajoute la class invalid au champs qui ne sont pas bon
                let errorInput = document.querySelector('.submit-form #description');
                errorInput.setAttribute('class', errorInput.className + ' invalid');
            }

            //compil les erreurs
            let textError = errorArray.join('<br>');

            //on affiche les erreurs
            errorPopupText.style.display = 'block';
            errorPopupText.innerHTML = textError;

        });
    }
}

//MONTRE OU CACHE LE LOADER AU SUBMIT D'UN FORM EN AJAX
function showSubmitLoader(visible) {
    let submitBtn = document.getElementById('submit-btn'),
        submitLoader = document.getElementById('submit-loader');

    if(visible){
        submitBtn.style.display = 'none';
        submitLoader.style.display = 'block';
    }else{
        submitBtn.style.display = 'block';
        submitLoader.style.display = 'none';
    }
}


//CALLBACK BASIC APRÈS UN SUBMIT EN AJAX : UN REFRESH DE LA PAGE
function refresh() {
    window.location.reload();
}


//CALLBACK CLASSIQUE QUI FERME LA MODAL OUVERTE
function closeModal() {
    $('#modal').modal('close');
}