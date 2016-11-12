<?php

namespace ISklep\API\Entities;

interface EntityObjectInterface
{
    /**
     * @return integer
     */
    public function getId();

    /**
     * @return string
     */
    public function getField();
}