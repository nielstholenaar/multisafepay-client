<?php namespace Ntholenaar\MultiSafepayClient\Request;

class IssuerRequest extends Request
{
    /**
     * {@inheritdoc}
     */
    protected $baseUrl = 'issuers';

    /**
     * Get all issuers for the provided gateway.
     *
     * @param $gatewayId
     * @return \Psr\Http\Message\RequestInterface
     */
    public function all($gatewayId)
    {
        return $this->get(
            $this->uriFactory->createUri($this->getBaseUrl() . '/' . $gatewayId)
        );
    }
}
