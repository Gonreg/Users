<?php

namespace application\core;

use application\lib\Db;

abstract class Model
{
    /**
     * @var Db
     */
    public Db $db;

    public function __construct()
    {
        $this->db = new Db();
    }
}

