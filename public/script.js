var button = document.getElementById('button');

button.onclick = function(){
    var cpf = document.getElementById('cpf');
    var status = document.getElementById('status');

    var form_to_block = document.getElementById('form_to_block');
    var form_to_free = document.getElementById('form_to_free');

    var cpf_to_block = document.getElementById('cpf_to_block');
    var cpf_to_free = document.getElementById('cpf_to_free');

    ajax('?r=/cpf/'+cpf.value, true, function(response){
        if (response.blocked) {
            status.innerHTML = 'BLOCKED';
            status.style.color = 'red';
            form_to_free.style.display = 'block';
            cpf_to_free.value = cpf.value;
        } else {
            status.innerHTML = 'FREE';
            status.style.color = 'green';
            form_to_block.style.display = 'block';
            cpf_to_block.value = cpf.value;
        }
    });

    return false;
};

function ajax(url, async, callable) {
    async = typeof async === 'undefined'? true: async;

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var response = JSON.parse(this.responseText);
            callable(response);
        }
    };

    xhr.open('GET', url, async);
    xhr.send();
}
