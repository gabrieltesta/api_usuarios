<?php

namespace Src\models;

class BaseModel
{
    protected int $id;

    public function __construct($id = null)
    {
        if($id)
            $this->id = $id;
    }

    private function isNew()
    {
        return is_null($this->id);
    }
}