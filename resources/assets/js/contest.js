function checkAll(check) {
    let checkboxes = document.getElementsByClassName('check-route-for-contest');
    for (let i = 0; i < checkboxes.length; i++) checkboxes[i].checked = check;
}