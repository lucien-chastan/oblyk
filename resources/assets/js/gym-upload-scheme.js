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
            showSubmitLoader(false);
        }
    );
}

function uploadSectorPicture(form, callback, gym_id) {
    let inputData = form.getElementsByClassName('input-data'),
        data = new FormData();

    showSubmitLoader(true);

    data.append('foo', 'bar');
    data.append('file', document.getElementById('upload-input-sector-picture').files[0]);

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

    axios.post('/modal/room/' + gym_id + '/sector/' + current_sector_id + '/upload-sector-picture', data, config).then(
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

function uploadRoutePicture(form, callback, gym_id) {
    let inputData = form.getElementsByClassName('input-data'),
        data = new FormData();

    showSubmitLoader(true);

    data.append('foo', 'bar');
    data.append('file', document.getElementById('upload-input-route-picture').files[0]);

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

    axios.post('/modal/room/' + gym_id + '/route/' + current_route_id + '/upload-route-picture', data, config).then(
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


function uploadRouteThumbnail(form, callback, gym_id) {
    let inputData = form.getElementsByClassName('input-data'),
        data = new FormData();

    showSubmitLoader(true);

    data.append('foo', 'bar');
    data.append('file', document.getElementById('upload-input-route-thumbnail').files[0]);

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

    axios.post('/modal/room/' + gym_id + '/route/' + current_route_id + '/upload-route-thumbnail', data, config).then(
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

function uploadRouteCrop(form, callback, gym_id) {
    cropper.croppie('result', 'base64').then(function(base64) {
        axios.post('/gym/' + gym_id + '/route/' + current_route_id + '/upload-crop-thumbnail', {
            base64: base64
        }).then(function (response) {
            closeModal();
            callback(response);
        });
        console.log(base64);
    });
}