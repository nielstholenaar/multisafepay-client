<?php namespace Ntholenaar\MultiSafepayClient\Request;

class FetchGatewayRequest extends AbstractRequest implements RequestInterface
{
    /**
     * {@inheritdoc}
     */
    protected $path = 'gateways';

    /**
     * @var string
     */
    protected $identifier;

    /**
     * Get the identifier.
     *
     * @return string|null
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set the identifier.
     *
     * @param $identifier
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function validate()
    {
        if ($this->getIdentifier() === null) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return parent::getPath() . '/' . $this->getIdentifier();
    }
}
