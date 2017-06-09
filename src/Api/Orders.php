<?php namespace Ntholenaar\MultiSafepayClient\Api;

class Orders extends AbstractApi
{
    /**
     * Show order.
     *
     * @param $identifier
     * @return Object|null
     */
    public function show($identifier)
    {
        return $this->get('/orders/' . rawurlencode($identifier));
    }

    /**
     * Create an redirect order.
     *
     * @param array $params
     * @return Object
     */
    public function createRedirectOrder(array $params)
    {
        $params['type'] = 'redirect';

        return $this->create($params);
    }

    /**
     * Create direct order.
     *
     * @param array $params
     * @return Object
     */
    public function createDirectOrder(array $params)
    {
        $params['type'] = 'direct';

        if (!array_key_exists('gateway', $params)) {
            throw new \InvalidArgumentException('Invalid data provided.');
        }

        return $this->create($params);
    }

    /**
     * Create order.
     *
     * @param array $params
     * @return Object
     */
    public function create(array $params)
    {
        if (!array_key_exists('amount', $params) ||
            !array_key_exists('currency', $params) ||
            !array_key_exists('description', $params) ||
            !array_key_exists('order_id', $params) ||
            !array_key_exists('payment_options', $params) ||
            !array_key_exists('type', $params)
        ) {
            throw new \InvalidArgumentException('Invalid data provided.');
        }

        return $this->post('/orders', [], $params);
    }
}
