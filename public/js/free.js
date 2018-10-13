var check = document.getElementById('check');
var free = document.getElementById('free');

free.onclick = function(){
    var cpf = document.getElementById('cpf');
    
    ajaxPOST('?r=/cpf/free', 'cpf='+cpf.value, function(response){
        if (response.message == 'CPF liberado!') {
            check.click();
        } else {
            alert(response.message);
        }
    });

    return false;
};
