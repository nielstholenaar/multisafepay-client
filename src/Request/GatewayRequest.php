<?php namespace Ntholenaar\MultiSafepayClient\Request;

class GatewayRequest extends Request
{
    /**
     * {@inheritdoc}
     */
    protected $baseUrl = 'gateways';

    /**
     * Get all gateways.
     *
     * @param null $country
     * @param null $currency
     * @param null $amount
     * @return \Psr\Http\Message\RequestInterface
     */
    public function all($country = null, $currency = null, $amount = null)
    {
        $uri = $this->getUriFactory()->createUri($this->getBaseUrl());

        $parameters = array_filter(
            compact('country', 'currency', 'amount')
        );

        return $this->get($uri, $parameters);
    }

    /**
     *
     * @param $identifier
     * @return \Psr\Http\Message\RequestInterface
     */
    public function show($identifier)
    {
        if (empty($identifier)) {
            throw new \InvalidArgumentException('Invalid identifier provided.');
        }

        return $this->get(
            $this->getUriFactory()->createUri($this->getBaseUrl() . '/' . $identifier)
        );
    }
}
