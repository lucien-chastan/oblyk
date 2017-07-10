let openAideStatus = [];

function openHelp(element) {
    let helpSection = document.getElementById(element);

    if(openAideStatus[element] !== true){
        openAideStatus[element] = true;
        helpSection.style.display = 'block';
        setTimeout(function () {
            helpSection.style.opacity = 1;
        },10);
    }else{
        openAideStatus[element] = false;
        helpSection.style.opacity = 0;
        setTimeout(function () {
            helpSection.style.display = 'none';
        },300);
    }
}