/*选中所有的记录*/
function selectAllCheckbox() {
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
/*删除选中的所有记录*/
function delLists() {
    var myform = document.getElementById('myform');
    var objs = document.getElementsByClassName('boxs');
    var isSelect = false;
    // 判断是否有选中的记录
    for (var i = 0; i < objs.length; i++){
        if (objs[i].checked){
            isSelect = true;
            break;
        }
    }
    if (!isSelect){
        alert('请至少选中一条记录!');
        return false;
    }
    // 提交
    if (confirm("确定全部删除？")){
        myform.submit;
    }else{
        return false;
    }
}