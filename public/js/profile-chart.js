
//VA CHERCHER LE GRAPHE DES TYPES DES GRIMPES D'UN USER
function getChartMyCross() {

    let user_id = document.getElementById('user-id-climb-type').value;

    console.log(user_id);

    axios.post('/chart/cross/climb-type', {user_id : user_id}).then(function (response) {
        let chart = new Chart(
            document.getElementById("chart-climb-id").getContext('2d'),
            JSON.parse(response.data)
        );
    });

}