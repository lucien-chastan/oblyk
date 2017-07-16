
//va chercher les posts
function getPosts(type, id, target, start = 0, skip = 5, route = '/post/getVue') {
    axios.post(route,{postable_type : type, postable_id : id, start : start, skip : skip}).then(function (response) {
        target.innerHTML += response.data;
        afterGetPost();
    });
}

//initialisation après être allé chercher les posts
function afterGetPost() {
    $('.tooltipped').tooltip({delay: 50});
    initOpenModal();
}

//Reload le post qui a été modifié
function reloadPost(response) {

    let data = JSON.parse(response.data),
        id = data.descriptive_id !== undefined ? data.descriptive_id : data.id;

    axios.post('/post/getOne',{id:id}).then(function (response) {
        document.getElementById('zone-post-' + id).innerHTML = response.data;
        afterGetPost();
    });

    closeModal();
}