<?php

namespace Src\controllers;

interface APIControllerInterface
{
    public function get(int $id);
    public function getAll();
    public function create(\stdClass $class);
    public function update(\stdClass $class);
    public function delete(int $id);

}