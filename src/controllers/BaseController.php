<?php

namespace Src\controllers;

use Src\models\BaseModel;

/**
 * Controller base
 *
 * @author Gabriel Testa | gabrielaugustotesta@gmail.com
 */
class BaseController
{
    protected string $model;
    protected bool $renderView = false;


    /**
     * Faz o redirecionamento para o método apropriado dependendo do método HTTP utilizado
     *
     * @param string $method Método HTTP (GET/POST/PUT/DELETE)
     * @param int|null $entityId
     */
    public function __construct(string $method = 'GET', ?int $entityId = null)
    {
        if(isset($_GET['view']))
            $this->renderView = true;

        if($method === 'POST') {
            $model = new $this->model();
            if(!empty($_POST))
                $model->getModelFromArray($_POST);

            $this->create($model);
        } elseif($method === 'PUT') {
            $model = new $this->model();
            if(!empty($_POST))
                $model->getModelFromArray($_POST);

            $this->update($entityId, $model);
        } elseif($method === 'DELETE')
            $this->delete($entityId);
        elseif($method === 'GET') {
            if($this->renderView) {
                header("Content-Type: text/html; charset=UTF-8");

                switch($GLOBALS['URL']) {
                    case 'users':
                        if($entityId)
                            $this->view($entityId);
                        else
                            $this->index();
                        break;
                    case 'users_add':
                        $this->add();
                        break;
                    case 'users_edit':
                        $this->edit($entityId);
                        break;
                    case 'users_delete':
                        $this->exclude($entityId);
                        break;
                }
            } else {
                if ($entityId)
                    $this->get($entityId);
                else
                    $this->getAll();
            }
        }
    }

    /**
     * Retorna um json padronizado para API, e encerra o processo.
     *
     * @param int $httpCode
     * @param string $message
     * @param array $body
     * @return void
     */
    public function responseAsJson(int $httpCode = 200, string $message = '', array $body = []): bool {
        http_response_code($httpCode);

        $response = [
            'code' => $httpCode,
            'message' => $message,
            'body' => $body
        ];

        exit(json_encode($response));
    }
}