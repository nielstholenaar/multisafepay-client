<?php namespace Ntholenaar\MultiSafepayClient\Requests;

use Ntholenaar\MultiSafepayClient\AbstractRequest;

class FetchGatewayRequest extends AbstractRequest implements RequestInterface
{
    /**
     * ListGatewaysRequest constructor.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters = array())
    {
        if (count($parameters) > 0) {
            $this->parseParameters($parameters);
        }
    }

    /**
     * Get the identifier.
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->getQueryParameter('id');
    }

    /**
     * Set the identifier.
     *
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->setQueryParameter('id', $id);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function validateParameters()
    {
        if ($this->getId() === null) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    protected function getUrl()
    {
        return 'gateways/' . $this->getId();
    }
}
