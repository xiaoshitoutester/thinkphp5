function selectAll() {
    var clidId = document.getElementById('selectAll');
    var clos = document.getElementsByClassName('boxs');
    if (clidId.checked){
        for (var i = 0; i < clos.length; i++){
            clos[i].checked = true;
        }
    }else{
        for (var i = 0; i < clos.length; i++){
            clos[i].checked = false;
        }
    }
}