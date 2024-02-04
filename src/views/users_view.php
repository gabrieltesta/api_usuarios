<?php /** @var $id  */?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <script type="application/javascript" src="./../src/js/users.js"> </script>
        <script type="application/javascript">
            findById(<?php echo $id ?>);
        </script>
        <style>
            #api_return {
                max-width: 1100px;
                height: 400px;
                overflow-y: auto;
                white-space: pre;
                font-family: monospace;
            }

            .form_container div {
                margin-bottom: 5px;
            }

            .form_container div label {
                display: block;
            }

            input:read-only, select:disabled {
                background-color: lightgrey;
            }
        </style>
    </head>
    <body>
        <h3>Usuário #<span class="id_user"></span>:</h3>
        <a href="../users?view=1">Voltar</a>
        <div class="form_container">
            <div>
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" readonly>
            </div>
            <div>
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" readonly>
            </div>
            <div>
                <label for="phone">Telefone:</label>
                <input type="text" id="phone" name="phone" maxlength="14" readonly>
            </div>
            <div>
                <label for="gender">E-mail:</label>
                <select id="gender" name="gender" disabled>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                    <option value="O">Outro</option>
                </select>
            </div>
<!--            <div>-->
<!--                <label for="password">Senha:</label>-->
<!--                <input type="password" id="password" name="password" readonly>-->
<!--            </div>-->
        </div>
        <h3>Retorno da API:</h3>
        <pre id="api_return">

        </pre>
    </body>
</html>