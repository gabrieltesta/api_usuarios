<?php

namespace Src\controllers;

use Src\models\BaseModel;

/**
 * Interface de controllers de api
 *
 * @author Gabriel Testa | gabrielaugustotesta@gmail.com
 */
interface APIControllerInterface
{
    public function get(int $id);
    public function getAll();
    public function create(BaseModel $entity);
    public function update(int $id, BaseModel $entity);
    public function delete(int $id);

}