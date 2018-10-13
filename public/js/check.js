var check = document.getElementById('check');

check.onclick = function(){
    var cpf = document.getElementById('cpf');
    var status = document.getElementById('status');

    var form_to_block = document.getElementById('form_to_block');
    var form_to_free = document.getElementById('form_to_free');

    var cpf_to_block = document.getElementById('cpf_to_block');
    var cpf_to_free = document.getElementById('cpf_to_free');

    ajaxGET('?r=/cpf/'+cpf.value, function(response){
        if (response.message) {
            alert(response.message);
            return false;
        }
        
        if (response.blocked) {
            status.innerHTML = 'BLOCKED';
            status.style.color = 'red';
            
            form_to_block.style.display = 'none';
            form_to_free.style.display = 'block';
            
            cpf_to_free.value = cpf.value;
        } else {
            status.innerHTML = 'FREE';
            status.style.color = 'green';
            
            form_to_free.style.display = 'none';
            form_to_block.style.display = 'block';
            
            cpf_to_block.value = cpf.value;
        }
    });

    return false;
};
