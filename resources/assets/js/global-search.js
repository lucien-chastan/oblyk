let timToGlobalSearch;

function globalSearche(searchInput) {
    let progress = document.getElementById('progressSearch'),
        cragZone = document.getElementById('global-search-crag');

    progress.style.opacity = '1';

    clearTimeout(timToGlobalSearch);

    timToGlobalSearch = setTimeout(function () {
        axios.get('/API/search/' + searchInput.value).then(function (response) {

            let data = response.data;

            console.log(response);

            cragZone.innerHTML = '';
            if(data.nombre.crags > 0){
                for(let i = 0 ; i < data.nombre.crags ; i++){
                    cragZone.innerHTML += `<p><a href="${data.crags[i].url}">${data.crags[i].label}</a></p>`;
                }
            }


            progress.style.opacity = '0';
        });
    },150);
}