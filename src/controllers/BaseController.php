<?php

namespace Src\controllers;

/**
 * Controller base
 *
 * @author Gabriel Testa | gabrielaugustotesta@gmail.com
 */
class BaseController
{
    protected $model;
    /**
     * Faz o redirecionamento para o método apropriado dependendo do método HTTP utilizado
     *
     * @param string $method Método HTTP (GET/POST/PUT/DELETE)
     * @param int|null $entityId
     */
    public function __construct(string $method = 'GET', ?int $entityId = null)
    {
        if($method === 'POST')
            $this->create((new $this->model())->getModelFromArray($_POST));
        elseif($method === 'PUT')
            $this->update($entityId, (new $this->model())->getModelFromArray($_POST));
        elseif($method === 'DELETE')
            $this->delete($entityId);
        elseif($method === 'GET') {
            if($entityId)
                $this->get($entityId);
            else
                $this->getAll();
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