<?php

namespace Src\controllers;

class BaseController
{
    public function __construct($metodo = 'GET', $entityId = null)
    {
        echo $metodo;
        if($metodo === 'GET') {
            if($entityId)
                $this->get($entityId);
            else
                $this->getAll();
        }

    }
}