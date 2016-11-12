<?php

namespace ISklep\API\Entities\Traits;

trait EntityObjectTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = intval($id);

        return $this;
    }
}