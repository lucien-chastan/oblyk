
//va chercher les posts
function getPosts(type, id, target, route = '/post/getVue', skip = 0, take = 10) {
    let skipIpt = document.getElementsByClassName('skip-post-val'),
        takeIpt = document.getElementsByClassName('take-post-val');

    if(skipIpt.length > 0){
        skip = skipIpt[(skipIpt.length - 1)].value;
        take = takeIpt[(takeIpt.length - 1)].value;
    }

    axios.post(route,{postable_type : type, postable_id : id, skip : skip, take : take}).then(function (response) {
        target.innerHTML += response.data;

        afterGetPost();
    });
}

//initialisation après être allé chercher les posts
function afterGetPost() {

    $('.tooltipped').tooltip({delay: 50});

    let insertZone = document.getElementById('insert-posts-zone'),
        btnModals = insertZone.getElementsByClassName('btnModal');
    for(let i = 0 ; i < btnModals.length ; i++) btnModals[i].setAttribute('data-parsed','false');

    initOpenModal();

    //si le bouton fin de post est la on cahce le nouton pour voir plus de fil
    let finPost = document.getElementsByClassName('information-fin-post');
    if(finPost.length > 0) document.getElementById('btn-see-more-post').style.display = 'none';

    showLoadedMorePost(false);
}

//Reload le post qui a été modifié
function reloadPost(response) {

    let data = JSON.parse(response.data),
        id = data.commentable_id !== undefined ? data.commentable_id : data.id;

    //si c'est une réponse à un commentaire
    if(data.commentable_type === 'App\\Comment') id = data.commentable.commentable_id;

    axios.post('/post/getOne',{id:id}).then(function (response) {
        document.getElementById('zone-post-' + id).innerHTML = response.data;
        afterGetPost();
    });

    closeModal();
}

//montre ou chache le loader de plus de post
function showLoadedMorePost(visible) {
    let loader = document.getElementById('div-loader-more-post'),
        btn = document.getElementById('btn-a-see-more-post'),
        finPost = document.getElementsByClassName('information-fin-post');

    if(finPost.length === 0){
        if(visible){
            loader.style.display = 'block';
            btn.style.display = 'none';
        }else{
            loader.style.display = 'none';
            btn.style.display = 'block';
        }
    }
}