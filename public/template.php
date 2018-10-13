<!doctype html>
<html>
    <head>
        <title>Blacklist de CPF's</title>
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>
        <form>
            <input type="text" id="cpf" placeholder='CPF' autofocus />
            <button id="button">Consultar</button>
        </form>
        
        <table>
            <tr><td>STATUS</td><td>AÇÕES</td></tr>
            
            <tr>
                <td id="status"></td>
                
                <td>
                    <form method="post" action="?r=/cpf/block" id="form_to_block" style="display: none">
                        <input type="hidden" name="cpf" id="cpf_to_block" />
                        <button>Bloquear</button>
                    </form>
                    
                    <form method="post" action="?r=/cpf/free" id="form_to_free" style="display: none">
                        <input type="hidden" name="cpf" id="cpf_to_free" />
                        <button>Liberar</button>
                    </form>
                </td>
            </tr>
        </table>
    </body>
    
    <script src="script.js"></script>
</html>
