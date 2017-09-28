function uploadPhoto(form, callback) {
    let route = form.getAttribute('data-route'),
        inputData = form.getElementsByClassName('input-data'),
        data = new FormData();

    showSubmitLoader(true);

    data.append('foo', 'bar');
    data.append('file', document.getElementById('upload-input-photo').files[0]);

    //ajout les autres données à passage de la form
    for(let i in inputData){
        if(typeof inputData[i].value !== "undefined") data.append([inputData[i].name], inputData[i].value);
    }

    let config = {
        onUploadProgress: function(progressEvent) {
            let percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
            document.getElementById('progressbar-upload-photo').style.width = percentCompleted + '%';
        }
    };

    axios.post(route, data, config).then(
        function (response) {
            closeModal();
            callback(response);
        }
    ).catch(
        function (err) {

            if(err.response.status === 422){

                //table des erreurs
                let errorArray = [];

                // on boucle sur les erreurs renvoyées
                for(let key in err.response.data){

                    //on ajout au tableau l'erreur courante
                    errorArray.push(err.response.data[key]);

                    try {
                        //on ajoute la class invalid au champs qui ne sont pas bon
                        let errorInput = form.querySelector("input[name='" + key + "']");
                        errorInput.setAttribute('class', errorInput.className + ' invalid');
                    }catch (e){}
                }

                //compil les erreurs
                let textError = errorArray.join('<br>');

                //on affiche les erreurs
                errorPopupText.style.display = 'block';
                errorPopupText.innerHTML = textError;
            }else{
                errorPopupText.style.display = 'block';
                errorPopupText.innerHTML = 'Erreur ' + err.response.status;
            }

            document.getElementById('progressbar-upload-photo').style.width = '0%';

            showSubmitLoader(false);
        }
    );
}