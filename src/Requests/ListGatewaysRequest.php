<?php namespace Ntholenaar\MultiSafepayClient\Requests;

use Ntholenaar\MultiSafepayClient\AbstractRequest;

class ListGatewaysRequest extends AbstractRequest implements RequestInterface
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
     * Get the country.
     *
     * @return string|null
     */
    public function getCountry()
    {
        return $this->getQueryParameter('country');
    }

    /**
     * Set the country.
     *
     * @param $country
     * @return $this
     */
    public function setCountry($country)
    {
        $this->setQueryParameter('country', $country);

        return $this;
    }

    /**
     * Get the currency.
     *
     * @return mixed|null
     */
    public function getCurrency()
    {
        return $this->getQueryParameter('currency');
    }

    /**
     * Set the currency.
     *
     * @param $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->setQueryParameter('currency', $currency);

        return $this;
    }

    /**
     * Get the amount.
     *
     * @return string|null
     */
    public function getAmount()
    {
        return $this->getQueryParameter('amount');
    }

    /**
     * Set the amount.
     *
     * @param $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->setQueryParameter('amount', $amount);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function validateParameters()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    protected function getUrl()
    {
        return 'gateways?' . http_build_query($this->queryParameters);
    }
}
