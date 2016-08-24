<?php namespace Ntholenaar\MultiSafepayClient\Request;

use Ntholenaar\MultiSafepayClient\Exception\InvalidRequestException;

class OrderRequest extends Request
{
    /**
     * {@inheritdoc}
     */
    protected $baseUrl = 'orders';

    /**
     * Show order.
     *
     * @param $identifier
     * @return \Psr\Http\Message\RequestInterface
     */
    public function show($identifier)
    {
        return $this->get(
            $this->uriFactory->createUri($this->getBaseUrl() . '/'. $identifier)
        );
    }

    /**
     * Create order.
     *
     * @param array $parameters
     * @throws InvalidRequestException
     * @return \Psr\Http\Message\RequestInterface
     */
    public function create(array $parameters)
    {
        $uri = $this->uriFactory->createUri($this->getBaseUrl());

        if (! array_key_exists('amount', $parameters) ||
            ! array_key_exists('currency', $parameters) ||
            ! array_key_exists('description', $parameters) ||
            ! array_key_exists('order_id', $parameters) ||
            ! array_key_exists('payment_options', $parameters) ||
            ! array_key_exists('type', $parameters)
        ) {
            throw new InvalidRequestException('Missing required parameters.');
        }

        return $this->post($uri, array(), $parameters);
    }

    /**
     * Create an direct order.
     *
     * @param array $parameters
     * @throws InvalidRequestException
     * @return \Psr\Http\Message\RequestInterface
     */
    public function createDirectOrder(array $parameters)
    {
        $parameters['type'] = 'direct';

        if (! array_key_exists('gateway', $parameters) ||
            ! array_key_exists('gateway_info', $parameters) ||
            ! array_key_exists('issuer_id', $parameters)
        ) {
            throw new InvalidRequestException('Missing required parameters.');
        }

        return $this->create($parameters);
    }

    /**
     * Create an redirect order.
     *
     * @param array $parameters
     * @throws InvalidRequestException
     * @return \Psr\Http\Message\RequestInterface
     */
    public function createRedirectOrder(array $parameters)
    {
        $parameters['type'] = 'redirect';

        return $this->create($parameters);
    }
}
