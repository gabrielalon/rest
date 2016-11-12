<?php

namespace ISystems\API\Entities;

use ISystems\API\Entities\Traits\EntityObjectTrait;

class PaymentMethod implements EntityObjectInterface
{
    use EntityObjectTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var boolean
     */
    protected $isActive;

    /**
     * @var string
     */
    protected $emailBody;

    /**
     * @var string
     */
    protected $additionalInfo;

    /**
     * @var boolean
     */
    protected $isPaidAtDeliveryTime;

    /**
     * @var integer
     */
    protected $pluginId;

    /**
     * @var integer
     */
    protected $ordering;

    /**
     * @return string
     */
    public function getField()
    {
        return 'payment_method';
    }

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
     * @return PaymentMethod
     */
    public function setName($name)
    {
        $this->name = strval($name);

        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param boolean $isActive
     *
     * @return PaymentMethod
     */
    public function setIsActive($isActive)
    {
        $this->isActive = boolval($isActive);

        return $this;
    }

    /**
     * @return string
     */
    public function getEmailBody()
    {
        return $this->emailBody;
    }

    /**
     * @param string $emailBody
     *
     * @return PaymentMethod
     */
    public function setEmailBody($emailBody)
    {
        $this->emailBody = strval($emailBody);

        return $this;
    }

    /**
     * @return string
     */
    public function getAdditionalInfo()
    {
        return $this->additionalInfo;
    }

    /**
     * @param string $additionalInfo
     *
     * @return PaymentMethod
     */
    public function setAdditionalInfo($additionalInfo)
    {
        $this->additionalInfo = strval($additionalInfo);

        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsPaidAtDeliveryTime()
    {
        return $this->isPaidAtDeliveryTime;
    }

    /**
     * @param boolean $isPaidAtDeliveryTime
     *
     * @return PaymentMethod
     */
    public function setIsPaidAtDeliveryTime($isPaidAtDeliveryTime)
    {
        $this->isPaidAtDeliveryTime = boolval($isPaidAtDeliveryTime);

        return $this;
    }

    /**
     * @return int
     */
    public function getPluginId()
    {
        return $this->pluginId;
    }

    /**
     * @param int $pluginId
     *
     * @return PaymentMethod
     */
    public function setPluginId($pluginId)
    {
        $this->pluginId = intval($pluginId);

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
     * @return PaymentMethod
     */
    public function setOrdering($ordering)
    {
        $this->ordering = intval($ordering);

        return $this;
    }
}