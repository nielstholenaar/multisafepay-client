<?php namespace Ntholenaar\MultiSafepayClient\Request;

class CreateDirectOrderRequest extends CreateOrderRequest implements RequestInterface
{
    /**
     * @param $environment
     * @param array $parameters
     * @param \Http\Message\MessageFactory|null $messageFactory
     */
    public function __construct($environment, array $parameters, $messageFactory)
    {
        parent::__construct($environment, $parameters, $messageFactory);

        $this->setType('direct');
    }

    /**
     * Get the recurring identifier.
     *
     * @return string|null
     */
    public function getRecurringId()
    {
        return $this->getRequestBodyParameter('recurring_id');
    }

    /**
     * Set the recurring identifier.
     *
     * @param $recurringId
     * @return $this
     */
    public function setRecurringId($recurringId)
    {
        $this->setRequestBodyParameter('recurring_id', $recurringId);

        return $this;
    }

    /**
     * Get the gateway info.
     *
     * @return array|null
     */
    public function getGatewayInfo()
    {
        return $this->getRequestBodyParameter('gateway_info');
    }

    /**
     * Set the gateway info.
     *
     * @param array $gatewayInfo
     * @return $this
     */
    public function setGatewayInfo(array $gatewayInfo)
    {
        // @todo validate, and filter invalid array keys.

        $this->setRequestBodyParameter('gateway_info', $gatewayInfo);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function validate()
    {
        if (parent::validate() === false ||
            is_null($this->getGatewayId()) ||
            is_null($this->getGatewayInfo()) ||
            is_null($this->getRecurringId())
        ) {
            return false;
        }

        return true;
    }
}
