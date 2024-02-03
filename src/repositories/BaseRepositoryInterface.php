<?php

namespace Src\repositories;

use Src\models\BaseModel;
use PDO;


interface BaseRepositoryInterface
{
    public function findAll();

    public function findById(int $id);

    public function create(BaseModel $object);

    public function update(BaseModel $object);

    public function delete(BaseModel $object);
}