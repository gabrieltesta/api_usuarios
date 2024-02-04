<?php /** @var $id  */?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <script type="application/javascript" src="./src/js/users.js"> </script>
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

            input:read-only, select:disabled, input[readonly] {
                background-color: lightgrey;
            }

            .color_error {
                color: red;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <h3>Novo Usuário<span class="id_user"></span>:</h3>
        <a href="./users?view=1">Voltar</a>
        <div class="form_container">
            <div>
                <label for="name">Nome: <span class="color_error">*</span></label>
                <input type="text" id="name" name="name">
            </div>
            <div>
                <label for="email">E-mail: <span class="color_error">*</span></label>
                <input type="text" id="email" name="email">
            </div>
            <div>
                <label for="phone">Telefone: <span class="color_error">*</span></label>
                <input type="text" id="phone" name="phone" maxlength="12">
            </div>
            <div>
                <label for="gender">E-mail: <span class="color_error">*</span></label>
                <select id="gender" name="gender">
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                    <option value="O">Outro</option>
                </select>
            </div>
            <div>
                <label for="password">Senha: <span class="color_error">*</span></label>
                <input type="password" id="password" name="password">
            </div>
            <div>
                <button type="button" id="saveUser" onclick="create()">Salvar</button>
            </div>
        </div>
        <h3>Retorno da API:</h3>
        <pre id="api_return">

        </pre>
    </body>
</html>