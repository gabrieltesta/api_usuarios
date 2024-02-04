<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <script type="application/javascript" src="./src/js/users.js"> </script>
        <script type="application/javascript">
            findAll();
        </script>
        <style>
            #api_return {
                max-width: 1100px;
                height: 400px;
                overflow-y: auto;
                white-space: pre;
                font-family: monospace;
            }

            #table_users {
                width: 1100px;
            }
        </style>
    </head>
    <body>
        <h3>Usuários:</h3>
        <a href="./users_add?view=1">Novo Usuário</a>
        <table id="table_users">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Gênero</th>
                <th>Data Criação</th>
                <th>Data Alteração</th>
                <th>Opções</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <h3>Retorno da API:</h3>
        <pre id="api_return">

        </pre>
    </body>
</html>