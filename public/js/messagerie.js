let currentConversation,
    timToUserSearch;

function loadConversation() {
    let insertConversations = document.getElementById('insert-conversation-list'),
        loader = document.getElementById('load-conversation-list');

    loader.style.display = 'block';
    insertConversations.style.display = 'none';

    axios.post('/messagerie/conversations').then(function (response) {
        insertConversations.innerHTML = response.data;

        loader.style.display = 'none';
        insertConversations.style.display = 'block';

    });
}

//recharge les conversations après en avoir ajouté une
function reloadConversationAfterAdd(response) {

    let data = JSON.parse(response.data);

    loadConversation();
    setTimeout(function () {
        getMessages(data.id);
    },700);
    closeModal();
}

//rechage les messages après avoir modifié le titre
function reloadMessageAfterEdit() {
    getMessages(currentConversation);
    closeModal();
}

//affiche le loader des messages
function showLoaderMessage(visible) {
    let insertMessages = document.getElementById('insert-message-list'),
        loader = document.getElementById('load-message-list'),
        messageZone = document.getElementById('message-text-zone');

    if (visible) {
        loader.style.display = 'block';
        insertMessages.style.display = 'none';
        messageZone.style.display = 'none';
    } else {
        loader.style.display = 'none';
        insertMessages.style.display = 'flex';
        messageZone.style.display = 'block';
    }

}

//va chercher les messages
function getMessages(conversation_id) {
    let insertMessages = document.getElementById('insert-message-list'),
        loader = document.getElementById('load-message-list'),
        blueDiv = document.getElementsByClassName('blue-border-convesation-div'),
        activeDiv = document.getElementById('conversation-div-' + conversation_id);

    //retire les actives des conversations
    for(let i = 0 ; i < blueDiv.length ; i++) {
        blueDiv[i].setAttribute('class', blueDiv[i].className.replace(' active', ''));
    }

    //active la conversation sélectonné et on enleve le gras
    try {
        activeDiv.setAttribute('class', activeDiv.className + ' active');
        activeDiv.setAttribute('class', activeDiv.className.replace(' text-bold', ''));
    }catch (e){}

    //requête ajax
    axios.post('/messagerie/messages', {conversation_id : conversation_id}).then(function (response) {

        currentConversation = conversation_id;

        insertMessages.innerHTML = response.data;

        showLoaderMessage(false);

        //initialise les tooltips
        $('.tooltipped').tooltip({delay: 50});

        //ajoute les événements open modal sur les boutons
        initOpenModal();

        goToLastMessage();
    });
}

function sendMessage() {
    let text = document.getElementById('textarea-message'),
        message = text.value;

    text.value = '';

    axios.post('/messages',{message : message, conversation_id : currentConversation}).then(function (response) {
        reloadMessageAfterEdit();
    });
}

function frappeText(e) {
    let text = document.getElementById('textarea-message');

    if(e.keyCode === 13 && e.ctrlKey && text.value !== '') {
        sendMessage();
    }
}

function goToLastMessage() {
    document.querySelector('#bottom-message-list').scrollIntoView({
        behavior: 'instant'
    });
}

function searchMessageUser() {
    let searcheText = document.getElementById('searche-message-user'),
        insertResult = document.getElementById('insert-user-message-search');

    //on annule la frappe précédente
    clearTimeout(timToUserSearch);

    if(searcheText.value !== ''){
        timToGlobalSearch = setTimeout(function () {
            axios.get('/messagerie/userSearch/' + currentConversation + '/' + searcheText.value).then(function (response) {

                let data = response.data;

                //RÉSULTAT SUR LES GRIMPEURS
                insertResult.innerHTML = '';
                if(data.nombre.users > 0){
                    for(let i = 0 ; i < data.nombre.users ; i++) {
                        insertResult.innerHTML += `<div class="col s12 blue-border-search crag-result result-user-message"><img class="left circle" src="${data.users[i].photo}"><a target="_blank" title="voir son profil" href="${data.users[i].url}">${data.users[i].name}</a><br><span class="grey-text">${data.users[i].genre}, ${data.users[i].age} ans</span><i title="ajouter à la conversation" onclick="addUserInConversation(${data.users[i].id})" class="material-icons right">person_add</i></div>`;
                    }
                }else{
                    insertResult.innerHTML = `<p class="text-center grey-text">il n\'y a pas de résultat pour : "${data.search}" dans les grimpeurs</p>`
                }
            });
        },200);
    }
}


function addUserInConversation(user_id) {

    axios.post('/messagerie/addUser',{user_id : user_id, conversation_id : currentConversation}).then(function (response) {

        let data = response.data;
        Materialize.toast( data.name + ' a été invité à rejoindre la conversation', 4000)

    });
    loadConversation();
    getMessages(currentConversation);
    closeModal();

}