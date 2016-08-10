<?php namespace Ntholenaar\MultiSafepayClient\Request;

class ListIssuersRequest extends AbstractRequest implements RequestInterface
{
    /**
     * {@inheritdoc}
     */
    protected $path = 'issuers';

    /**
     * Get the gateway.
     *
     * @return string|null
     */
    public function getGatewayIdentifier()
    {
        return $this->getQueryParameter('gateway_id');
    }

    /**
     * Set the gateway identifier.
     *
     * @param string $gatewayId
     * @return $this
     */
    public function setGatewayIdentifier($gatewayId)
    {
        $this->setQueryParameter('gateway_id', $gatewayId);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function validate()
    {
        if ($this->getGatewayIdentifier() === null) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return parent::getPath() . '/' . $this->getGatewayIdentifier();
    }
}
