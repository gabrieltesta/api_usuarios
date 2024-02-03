<?php

namespace Src\controllers;

use Src\Database;
use Src\models\BaseModel;
use Src\models\User;
use Src\repositories\UserRepository;

class UserController extends BaseController implements APIControllerInterface
{
    protected UserRepository $repository;

    public function __construct(string $method = 'GET', ?int $entityId = null)
    {
        $db = (new Database())->getConexao();
        $this->repository = new UserRepository($db);

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

    public function create(BaseModel $entity)
    {
        //TODO: Implementar serviço de validação

        $result = $this->repository->create($entity);
        if($result) {
            $entity->setId($result);
            $this->responseAsJson(201, 'Usuário criado com sucesso.', $entity->serialize());
        } else
            $this->responseAsJson(422, 'Erro na validação dos dados enviados.');

    }

    public function update(int $id, BaseModel $entity)
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }
}