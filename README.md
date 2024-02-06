## API de usuários em PHP 7.4.3 (puro)

- https://github.com/gabrieltesta/api_usuarios
- Baseado em teste inicial estipulado.
- Desenvolvido em PHP 7.4.3, sem utilização de *frameworks*, e MySQL.

#### Configuração Inicial:

 - É necessário que a configuração de "mod_rewrite" esteja ativa no servidor.
	 - Para ativar no XAMPP: 
		 - C:\xampp\apache\conf
		 - Retire o comentário da linha `#LoadModule rewrite_module modules/mod_rewrite.so`
		 - Mude todas as ocorrências de `AllowOverride None` para `AllowOverride All`
         - Colocar os arquivos deste repositório na raíz da pasta `C:/xampp/htdocs`
	 - Para ativar no WAMP:
 		 - C:\wamp\bin\apache\Apache2.2.11\conf
		 - Retire o comentário da linha `#LoadModule rewrite_module modules/mod_rewrite.so`
		 - Mude todas as ocorrências de `AllowOverride None` para `AllowOverride All`
         - Colocar os arquivos deste repositório na raiz da pasta `C:/wamp/www`

 - Para configuração inicial do banco de dados MySQL:
	 - A conexão com o banco de dados é feita pelo arquivo .env, e por padrão foram utilizadas as credenciais padrão do MySQL no XAMPP:
		 - Usuário: "root" (pode ser alterado pela config DB_USERNAME)
		 - Senha: "" (pode ser alterado pela config DB_PASSWORD)
	 - Execute o arquivo `create_db.sql` no banco de dados MySQL para criação de schema, tabela e *seed* inicial.
 - Para configuração inicial das dependências, é necessário o `composer`.
	 - Utilize o comando `composer install`.

 - Os *endpoints* descritos abaixo possuem *string* cURL para teste, mas é possível importar uma *collection* do Postman utilizando o arquivo `Users API.postman_collection.json`.

------------------------------------------------------------------------------------------

### Usuários (API)

<details>
 <summary><code>GET</code> <code><b>/users</b></code> Retorna a lista de todos os usuários.</summary>

##### Parâmetros

> Nenhum

##### Responses

> | código HTTP     | content-type                      | response                                                            |
> |---------------|-----------------------------------|---------------------------------------------------------------------|
> | `200`         | `application/json;charset=UTF-8`        | String JSON                                                         |

##### String cURL

> ```javascript
>  curl -X GET -H "Content-Type: application/json" http://localhost/users
> ```

</details>


------------------------------------------------------------------------------------------
<details>
 <summary><code>GET</code> <code><b>/users/{id}</b></code> Retorna os detalhes de um usuário específico.</summary>

##### Parâmetros

> | nome |  tipo     | tipo do dado      | descrição                         |
> |-------------------|-----------|----------------|-------------------------------------|
> | `id` |  required | int   | O código primário do registro de usuário        |

##### Responses

> | código HTTP     | content-type                      | response                                                            |
> |---------------|-----------------------------------|---------------------------------------------------------------------|
> | `200`         | `application/json;charset=UTF-8`        | String JSON                                                         |
> | `404`         | `application/json;charset=UTF-8`                | `{"code":"404","message":"Nenhum registro encontrado.", "body": []}`                            |

##### String cURL

> ```javascript
>  curl -X GET -H "Content-Type: application/json" http://localhost/users/1 
>  ```
</details>

------------------------------------------------------------------------------------------
<details>
 <summary><code>POST</code> <code><b>/users</b></code> Cria um novo usuário.</summary>

##### Parâmetros
>Nenhum

##### Corpo do request

> | nome |  tipo     | tipo do dado      | descrição                         |
> |-------------------|-----------|----------------|-------------------------------------|
> | `nome` |  required | string | Nome completo        |
> | `email` |  required | string | E-mail        |
> | `phone` |  required | string | Telefone        |
> | `gender` |  required | char | Gênero (M/F/O)        |
> | `password` |  required | string | Senha        |

##### Responses

> | código HTTP     | content-type                      | response                                                            |
> |---------------|-----------------------------------|---------------------------------------------------------------------|
> | `200`         | `application/json;charset=UTF-8`        | String JSON                                                         |
> | `422`         | `application/json;charset=UTF-8`                | `{"code":"422","message":"Erro na validação dos dados enviados", "body": [Lista de erros encontrados]}`                            |
> | `500`         | `application/json;charset=UTF-8`                | `{"code":"500","message":"Houve um erro inesperado. Tente novamente", "body": []}`                            |

##### String cURL

> ```javascript
>  curl -XPOST -H "Content-type: application/json" -d '{"name": "Teste API", "email": "testeapi1@exemplo.com", "phone": "011986394488", "gender": "O", "password": "banana"}' http://localhost/users
>  ```
</details>

------------------------------------------------------------------------------------------

<details>
 <summary><code>PUT</code> <code><b>/users/{id}</b></code> Atualiza os dados de um usuário existente.</summary>

##### Parâmetros
> | nome |  tipo     | tipo do dado      | descrição                         |
> |-------------------|-----------|----------------|-------------------------------------|
> | `id` |  required | int   | O código primário do registro de usuário        |

##### Corpo do request

> | nome |  tipo     | tipo do dado      | descrição                         |
> |-------------------|-----------|----------------|-------------------------------------|
> | `nome` |  opcional | string | Nome completo        |
> | `email` |  opcional | string | E-mail        |
> | `phone` |  opcional | string | Telefone        |
> | `gender` |  opcional  | char | Gênero (M/F/O)        |
> | `password` |  opcional | string | Senha        |

##### Responses

> | código HTTP     | content-type                      | response                                                            |
> |---------------|-----------------------------------|---------------------------------------------------------------------|
> | `200`         | `application/json;charset=UTF-8`        | String JSON                                                         |
> | `422`         | `application/json;charset=UTF-8`                | `{"code":"422","message":"Erro na validação dos dados enviados", "body": [Lista de erros encontrados]}`                            |
> | `500`         | `application/json;charset=UTF-8`                | `{"code":"500","message":"Houve um erro inesperado. Tente novamente", "body": []}`                            |

##### String cURL

> ```javascript
>  curl -X PUT -H "Content-type: application/json" -d '{"name": "Teste API",  "email": "testeapi1@exemplo.com", "phone":"011986394488", "gender": "O", "password": "banana"}' http://localhost/users/1
>  ```
</details>

------------------------------------------------------------------------------------------

<details>
 <summary><code>DELETE</code> <code><b>/users/{id}</b></code> Remove um usuário existente.</summary>

##### Parâmetros
> | nome |  tipo     | tipo do dado      | descrição                         |
> |-------------------|-----------|----------------|-------------------------------------|
> | `id` |  required | int   | O código primário do registro de usuário        |

##### Responses

> | código HTTP     | content-type                      | response                                                            |
> |---------------|-----------------------------------|---------------------------------------------------------------------|
> | `200`         | `application/json;charset=UTF-8`        | String JSON                                                         |
> | `500`         | `application/json;charset=UTF-8`                | `{"code":"500","message":"Houve um erro inesperado. Tente novamente", "body": []}`                            |

##### String cURL

> ```javascript
>  curl -X DELETE -H "Content-type: application/json" http://localhost/users/1
>  ```
</details>

------------------------------------------------------------------------------------------

### Usuários (Views)

Foi desenvolvida uma view simples em HTML puro, apenas para exemplificar a utilização das APIs via Ajax.
Para chegar nos endpoints, é necessário a utilização do parâmetro GET "view", com qualquer valor.

> | função     | url                     | 
> |---------------|-----------------------------------|
> | Listagem com todos os usuários         | /users?view=1        | 
> | Detalhes do usuário específico        | /users/{id}?view=1        | 
> | Criação de novo usuário         | /users_add?view=1        | 
> | Edição de usuário         | /users_edit/{id}?view=1        | 
> | Exclusão de usuário         | /users_delete/{id}?view=1        | 
