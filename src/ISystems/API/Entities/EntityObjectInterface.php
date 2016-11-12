<?php

namespace ISystems\API\Entities;

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