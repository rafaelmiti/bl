var check = document.getElementById('check');
var block = document.getElementById('block');

block.onclick = function(){
    var cpf = document.getElementById('cpf');
    
    ajaxPOST('?r=/cpf/block', 'cpf='+cpf.value, function(response){
        if (response.message == 'CPF bloqueado!') {
            check.click();
        } else {
            alert(response.message);
        }
    });

    return false;
};
