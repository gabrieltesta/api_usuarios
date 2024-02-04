function findAll() {
    let ajax = new XMLHttpRequest();
    let url = './users';

    ajax.open('GET', url, true);
    ajax.send();
    ajax.onreadystatechange = () => {
        if(ajax.readyState === 4 && ajax.status === 200) {
            let data = ajax.responseText;

            data = JSON.parse(data);
            document.querySelector('#api_return').innerHTML = JSON.stringify(data, null, "\t");


            let htmlTable = '';
            for(let i = 0; i < data.body.length; i++) {
                let item = data.body[i];
                htmlTable += `<tr>
                    <td>${item.id}</td>
                    <td>${item.name}</td>
                    <td>${item.email}</td>
                    <td>${item.phone}</td>
                    <td>${item.gender}</td>
                    <td>${item.created_at}</td>
                    <td>${(item.updated_at ? item.updated_at : '')}</td>
                    <td>
                        <a href="./users/${item.id}?view=1">Visualizar</a>&ensp;
                        <a href="./users_edit/${item.id}?view=1">Editar</a>&ensp;
                        <a href="./users_delete/${item.id}?view=1">Excluir</a>
                    </td>
                </tr>`;
            }
            document.querySelector('#table_users tbody').innerHTML = htmlTable;
        }
    }
}

function findById(id) {
    let ajax = new XMLHttpRequest();
    let url = './'+id;

    ajax.open('GET', url, true);
    ajax.send();
    ajax.onreadystatechange = () => {
        if(ajax.readyState === 4 && ajax.status === 200) {
            let data = ajax.responseText;

            data = JSON.parse(data);
            document.querySelector('#api_return').innerHTML = JSON.stringify(data, null, "\t");

            document.querySelector('.id_user').innerHTML = data.body.id;

            document.querySelector('#name').value = data.body.name;
            document.querySelector('#email').value = data.body.email;
            document.querySelector('#phone').value = data.body.phone;
            document.querySelector(`#gender option[value="${data.body.gender}"]`).selected = true;
        }
    }
}

function create() {
    let name = document.querySelector('#name').value;
    let email = document.querySelector('#email').value;
    let phone = document.querySelector('#phone').value;
    let gender = document.querySelector('#gender option:checked').value;
    let password = document.querySelector('#password').value;

    if(!name || !email || !phone || !gender || !password) {
        alert('Todos os campos são obrigatórios.')
        return false;
    }

    let postData = {
        name: name,
        email: email,
        phone: phone,
        gender: gender,
        password: password
    };

    let ajax = new XMLHttpRequest();
    let url = './users';

    ajax.open('POST', url, true);

    ajax.send(JSON.stringify(postData));
    ajax.onreadystatechange = () => {
        if(ajax.readyState === 4 && ajax.status === 201) {
            alert('Usuário incluído com sucesso.');
            let data = ajax.responseText;

            data = JSON.parse(data);
            document.querySelector('#api_return').innerHTML = JSON.stringify(data, null, "\t");

            document.querySelector('#saveUser').disabled = true;
            document.querySelector('#gender').disabled = true;
            document.querySelector('#name').readOnly = true;
            document.querySelector('#email').readOnly = true;
            document.querySelector('#phone').readOnly = true;
            document.querySelector('#password').readOnly = true;
            document.querySelector('#password').readOnly = true;
        }
    }
}

function exclude(id){
    let ajax = new XMLHttpRequest();
    let url = './'+id;

    ajax.open('DELETE', url, true);
    ajax.send();

    ajax.onreadystatechange = () => {
        if(ajax.readyState === 4 && ajax.status === 200) {
            alert('Usuário excluído com sucesso.');
            let data = ajax.responseText;

            data = JSON.parse(data);
            document.querySelector('#api_return_delete').innerHTML = JSON.stringify(data, null, "\t");

            document.querySelector('#excludeUser').disabled = true;
        }
    }
}

function update(id) {
    let name = document.querySelector('#name').value;
    let email = document.querySelector('#email').value;
    let phone = document.querySelector('#phone').value;
    let gender = document.querySelector('#gender option:checked').value;

    if(!name || !email || !phone || !gender) {
        alert('Todos os campos são obrigatórios.')
        return false;
    }

    let postData = {
        name: name,
        email: email,
        phone: phone,
        gender: gender,
    };

    let ajax = new XMLHttpRequest();
    let url = './'+id;

    ajax.open('PUT', url, true);

    ajax.send(JSON.stringify(postData));

    ajax.onreadystatechange = () => {
        if(ajax.readyState === 4 && ajax.status === 200) {
            alert('Usuário editado com sucesso.');
            let data = ajax.responseText;

            data = JSON.parse(data);
            document.querySelector('#api_return_update').innerHTML = JSON.stringify(data, null, "\t");
        }
    }
}