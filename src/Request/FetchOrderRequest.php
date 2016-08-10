<?php namespace Ntholenaar\MultiSafepayClient\Request;

class FetchOrderRequest extends AbstractRequest implements RequestInterface
{
    /**
     * {@inheritdoc}
     */
    protected $path = 'orders';

    /**
     * Get the identifier.
     *
     * @return string|null
     */
    public function getIdentifier()
    {
        return $this->getQueryParameter('identifier');
    }

    /**
     * Set the identifier.
     *
     * @param $identifier
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        $this->setQueryParameter('identifier', $identifier);

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
