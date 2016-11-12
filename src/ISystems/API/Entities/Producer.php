<?php

namespace ISystems\API\Entities;

use ISystems\API\Entities\Traits\EntityObjectTrait;

class Producer implements EntityObjectInterface
{
    use EntityObjectTrait;

    /**
     * @return string
     */
    public function getField()
    {
        return 'producer';
    }

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $siteUrl;

    /**
     * @var string
     */
    protected $logoFilename;

    /**
     * @var integer
     */
    protected $ordering;

    /**
     * @var string
     */
    protected $sourceId;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Producer
     */
    public function setName($name)
    {
        $this->name = strval($name);

        return $this;
    }

    /**
     * @return string
     */
    public function getSiteUrl()
    {
        return $this->siteUrl;
    }

    /**
     * @param string $siteUrl
     *
     * @return Producer
     */
    public function setSiteUrl($siteUrl)
    {
        $this->siteUrl = strval($siteUrl);

        return $this;
    }

    /**
     * @return string
     */
    public function getLogoFilename()
    {
        return $this->logoFilename;
    }

    /**
     * @param string $logoFilename
     *
     * @return Producer
     */
    public function setLogoFilename($logoFilename)
    {
        $this->logoFilename = strval($logoFilename);

        return $this;
    }

    /**
     * @return int
     */
    public function getOrdering()
    {
        return $this->ordering;
    }

    /**
     * @param int $ordering
     *
     * @return Producer
     */
    public function setOrdering($ordering)
    {
        $this->ordering = intval($ordering);

        return $this;
    }

    /**
     * @return string
     */
    public function getSourceId()
    {
        return $this->sourceId;
    }

    /**
     * @param string $sourceId
     *
     * @return Producer
     */
    public function setSourceId($sourceId)
    {
        $this->sourceId = strval($sourceId);

        return $this;
    }
}