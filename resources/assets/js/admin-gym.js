var nav_barre = document.getElementById('nav_barre'), collapseTable = [];
nav_barre.setAttribute('class', nav_barre.className.replace('nav-white','nav-black'));

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