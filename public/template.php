<!doctype html>
<html>
    <head>
        <title>Blacklist de CPF's</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    
    <body>
        <form>
            <input type="text" id="cpf" placeholder='CPF' autofocus />
            <button id="check">Consultar</button>
        </form>
        
        <table>
            <tr><td>STATUS</td><td>AÇÕES</td></tr>
            
            <tr>
                <td id="status"></td>
                
                <td>
                    <form id="form_to_block" style="display: none">
                        <input type="hidden" id="cpf_to_block" />
                        <button id="block">Bloquear</button>
                    </form>
                    
                    <form id="form_to_free" style="display: none">
                        <input type="hidden" id="cpf_to_free" />
                        <button id="free">Liberar</button>
                    </form>
                </td>
            </tr>
        </table>
    </body>
    
    <script src="js/ajax.js"></script>
    <script src="js/check.js"></script>
    <script src="js/block.js"></script>
    <script src="js/free.js"></script>
</html>
