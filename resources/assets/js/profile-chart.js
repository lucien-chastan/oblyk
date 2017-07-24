
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

function cocheFiltre(check, elementName) {
    let checkboxes = document.getElementsByName(elementName);
    for(let i = 0 ; i < checkboxes.length ; i++) checkboxes[i].checked = check;
}

function visibleFilterPeriod(switchbox) {
    let divFilter = document.getElementById('div-filter-period');
    divFilter.style.display = switchbox.checked === true ? 'block' : 'none';
}

function submitFilter() {
    let statusesIpt = document.getElementsByName('statusesFilter'),
        statusesArray = {},
        climbsIpt = document.getElementsByName('climbsFilter'),
        climbsArray = {},
        switchFilter = document.getElementById('switch-filter'),
        climbStart  = document.getElementById('climb-filter-start'),
        climbEnd  = document.getElementById('climb-filter-end'),
        periodFilter = '';

    for(let i = 0 ; i < statusesIpt.length ; i++) statusesArray[statusesIpt[i].value] = (statusesIpt[i].checked === true);
    for(let i = 0 ; i < climbsIpt.length ; i++) climbsArray[climbsIpt[i].value] = (climbsIpt[i].checked === true);

    if(switchFilter.checked === true) {
        periodFilter = '{"start":"' + climbStart.value + '","end":"' + climbEnd.value + '"}';
    }else{
        periodFilter = '{"start":"first","end":"now"}';
    }

    axios.post('/user/settings/filter',{
        filter_climb : JSON.stringify(climbsArray),
        filter_status : JSON.stringify(statusesArray),
        filter_period : periodFilter
    }).then(function (response) {
        Materialize.toast(response.data, 4000);
    });
}