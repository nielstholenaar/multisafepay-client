<?php namespace Ntholenaar\MultiSafepayClient\Api;

class Issuers extends AbstractApi
{
    /**
     * Get all issuers for the specified gateway.
     *
     * @param $gatewayId
     * @return array
     */
    public function all($gatewayId)
    {
        return $this->get('/issuers/' . rawurlencode($gatewayId));
    }
}
