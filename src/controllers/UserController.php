<?php

namespace Src\controllers;

use Src\Database;
use Src\models\BaseModel;
use Src\models\User;
use Src\repositories\UserRepository;
use Src\services\ValidationService;

class UserController extends BaseController implements APIControllerInterface
{
    protected UserRepository $repository;
    protected ValidationService $validation;

    public function __construct(string $method = 'GET', ?int $entityId = null)
    {
        $db = (new Database())->getConexao();
        $this->repository = new UserRepository($db);
        $this->validation = new ValidationService();

        $this->model = User::class;

        parent::__construct($method, $entityId);
    }

    /**
     * @link /users/{id} [GET]
     *
     * @param int $id
     * @return void
     */
    public function get(int $id)
    {
        $user = $this->repository->findById($id);
        if(!$user)
            $this->responseAsJson(404, 'Nenhum registro encontrado.');

        $this->responseAsJson(200, '', $user->serialize());
    }

    /**
     * @link /users/ [GET]
     *
     * @return void
     */
    public function getAll()
    {
        $users = $this->repository->findAll();

        $this->responseAsJson(200, '', $users);
    }

    /**
     * @link /users/ [POST]
     *
     * @param BaseModel $entity
     * @return bool
     */
    public function create(BaseModel $entity): bool
    {
        if(!$this->validation->validate($_POST, [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'gender' => ['required', ['length' => 1], ['enum' => 'M,F,O']],
            'password' => ['required']
        ]))
            return $this->responseAsJson(422, 'Erro na validação dos dados enviados', $this->validation->getErrors());

        $result = $this->repository->create($entity);
        if($result) {
            $entity->setId($result);
            $this->responseAsJson(201, 'Usuário criado com sucesso.', $entity->serialize());
        } else
            $this->responseAsJson(500, 'Houve um erro inesperado. Tente novamente.');

        return true;
    }

    /**
     * @link /users/{id} [PUT]
     *
     * @param int $id
     * @param BaseModel $entity
     * @return bool
     */
    public function update(int $id, BaseModel $entity): bool
    {
        if(!$this->validation->validate($_POST, [
            'email' => ['email'],
            'gender' => [['length' => 1], ['enum' => 'M,F,O']]
        ]))
            return $this->responseAsJson(422, 'Erro na validação dos dados enviados', $this->validation->getErrors());

        $result = $this->repository->update($id, $entity);
        if($result)
            $this->responseAsJson(200, 'Usuário atualizado com sucesso.');
        else
            $this->responseAsJson(500, 'Houve um erro inesperado. Tente novamente.');

        return true;
    }

    /**
     * @link /users/{id} [DELETE]
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id)
    {
        $result = $this->repository->delete($id);
        if($result)
            $this->responseAsJson(200, 'Usuário excluído com sucesso.');
        else
            $this->responseAsJson(500, 'Houve um erro inesperado. Tente novamente.');
    }


    /**
     * @link /users?view=1 [GET]
     * @return void
     */
    public function index() {
        require_once('../views/users.php');
    }

    /**
     * @link /users/{id}?view=1 [GET]
     *
     * @param int $id
     * @return void
     */
    public function view(int $id) {
        require_once('../views/users_view.php');
    }

    /**
     * @link /users_add?view=1 [GET]
     * @return void
     */
    public function add() {
        require_once('../views/users_add.php');
    }


    /**
     * @link /users_delete?view=1 [GET]
     * @param int $id
     * @return void
     */
    public function exclude(int $id) {
        require_once('../views/users_delete.php');
    }

    /**
     * @link /users_edit?view=1 [GET]
     * @param int $id
     * @return void
     */
    public function edit(int $id) {
        require_once('../views/users_edit.php');
    }
}