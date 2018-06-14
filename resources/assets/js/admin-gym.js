var nav_barre = document.getElementById('nav_barre'), collapseTable = [];
nav_barre.setAttribute('class', nav_barre.className.replace('nav-white','nav-black'));

var delay = (function(){
    // https://stackoverflow.com/a/1909508
    var timer = 0;
    return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
    };
})();

function uploadScheme(form, callback, gym_id) {
    let inputData = form.getElementsByClassName('input-data'),
        data = new FormData();

    showSubmitLoader(true);

    data.append('foo', 'bar');
    data.append('file', document.getElementById('upload-input-scheme-topo').files[0]);

    //ajout les autres données à passage de la form
    for(let i in inputData){
        if(typeof inputData[i].value !== "undefined") data.append([inputData[i].name], inputData[i].value);
    }

    let config = {
        onUploadProgress: function(progressEvent) {
            let percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
            document.getElementById('progressbar-upload-scheme').style.width = percentCompleted + '%';
        }
    };

    axios.post('/modal/room/' + gym_id + '/upload-scheme', data, config).then(
        function (response) {
            closeModal();
            callback(response);
        }
    ).catch(
        function (err) {
            console.log(err.message);
            showSubmitLoader(false);
        }
    );
}

function searchUser() {
    delay(function(){
        getUserByName();
    }, 500 );
}

function getUserByName(){
    var div_liste = document.getElementById('find-user-list'),
        userSearcheInput = document.getElementById('search-user-name'),
        gymId = document.getElementById('gym_id').value;

    div_liste.innerHTML = '';

    axios.get('/API/users/by-name/' + gymId + '/' + userSearcheInput.value).then(function (response) {
        div_liste.innerHTML = response.data;
    });
}

function addTeamMember(user_id) {
    var gymId = document.getElementById('gym_id').value;
    axios.post(
        '/admin/administrator/add/' + gymId + '/' + user_id,
        {
            'gym_id': gymId,
            'user_id': user_id
        }
    ).then(function () {
        Materialize.toast('Membre ajouté', 4000);
        reloadCurrentVue();
    });
}