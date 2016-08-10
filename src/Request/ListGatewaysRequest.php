<?php namespace Ntholenaar\MultiSafepayClient\Request;

class ListGatewaysRequest extends AbstractRequest implements RequestInterface
{
    /**
     * {@inheritdoc}
     */
    protected $path = 'gateways';

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
    public function validate()
    {
        return true;
    }
}
