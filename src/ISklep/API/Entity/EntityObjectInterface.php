<?php

namespace ISklep\API\Entity;

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