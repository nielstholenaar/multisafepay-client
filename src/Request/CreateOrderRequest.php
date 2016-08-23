<?php namespace Ntholenaar\MultiSafepayClient\Request;

class CreateOrderRequest extends AbstractRequest implements RequestInterface
{
    /**
     * {@inheritdoc}
     */
    protected $httpMethod = 'POST';

    /**
     * {@inheritdoc}
     */
    protected $path = 'orders';

    /**
     * {@inheritdoc}
     */
    public function validate()
    {
        if (! isset($this->getPaymentOptions()['cancel_url']) ||
            ! isset($this->getPaymentOptions()['notification_url']) ||
            ! isset($this->getPaymentOptions()['redirect_url']) ||
            is_null($this->getAmount()) ||
            is_null($this->getCurrency()) ||
            is_null($this->getDescription()) ||
            is_null($this->getOrderId()) ||
            is_null($this->getPaymentOptions()) ||
            is_null($this->getType())
        ) {
            return false;
        }

        return true;
    }

    /**
     * Get the type.
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->getRequestBodyParameter('type');
    }

    /**
     * Set the type.
     *
     * @param $type
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setType($type)
    {
        if ($type !== 'direct' && $type !== 'redirect') {
            throw new \InvalidArgumentException('Invalid type provided.');
        }

        $this->setRequestBodyParameter('type', $type);

        return $this;
    }

    /**
     * Get the order identifier.
     *
     * @return mixed|null
     */
    public function getOrderId()
    {
        return $this->getRequestBodyParameter('order_id');
    }

    /**
     * Set the order identifier.
     *
     * @param $orderId
     * @return $this
     */
    public function setOrderId($orderId)
    {
        $this->setRequestBodyParameter('order_id', $orderId);

        return $this;
    }

    /**
     * Get the currency.
     *
     * @return null
     */
    public function getCurrency()
    {
        return $this->getRequestBodyParameter('currency');
    }

    /**
     * Set the currency.
     *
     * @param $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->setRequestBodyParameter('currency', $currency);

        return $this;
    }

    /**
     * Get the amount.
     *
     * @return double|null
     */
    public function getAmount()
    {
        return $this->getRequestBodyParameter('amount');
    }

    /**
     * Set the amount.
     *
     * @param $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->setRequestBodyParameter('amount', $amount);

        return $this;
    }

    /**
     * Get the description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->getRequestBodyParameter('description');
    }

    /**
     * Set the description.
     *
     * @param $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->setRequestBodyParameter('description', $description);

        return $this;
    }

    /**
     * Get the gateway identifier.
     *
     * @return string|null
     */
    public function getGatewayId()
    {
        return $this->getRequestBodyParameter('gateway_id');
    }

    /**
     * Set the gateway identifier.
     *
     * @param $gatewayId
     * @return $this
     */
    public function setGatewayId($gatewayId)
    {
        $this->setRequestBodyParameter('gateway_id', $gatewayId);

        return $this;
    }

    /**
     * Get the value of var1.
     *
     * @return string|null
     */
    public function getVar1()
    {
        return $this->getRequestBodyParameter('var1');
    }

    /**
     * Set the value of var1.
     *
     * @param $var1
     * @return $this
     */
    public function setVar1($var1)
    {
        $this->setRequestBodyParameter('var1', $var1);

        return $this;
    }

    /**
     * Get the value of var2.
     *
     * @return string|null
     */
    public function getVar2()
    {
        return $this->getRequestBodyParameter('var2');
    }

    /**
     * Set the value of var2.
     *
     * @param $var2
     * @return $this
     */
    public function setVar2($var2)
    {
        $this->setRequestBodyParameter('var2', $var2);

        return $this;
    }

    /**
     * Get the value of var3.
     *
     * @return string|null
     */
    public function getVar3()
    {
        return $this->getRequestBodyParameter('var3');
    }

    /**
     * Set the value of var3.
     *
     * @param $var3
     * @return $this
     */
    public function setVar3($var3)
    {
        $this->setRequestBodyParameter('var3', $var3);

        return $this;
    }

    /**
     * Get the items.
     *
     * @return array|null
     */
    public function getItems()
    {
        return $this->getRequestBodyParameter('items');
    }

    /**
     * Set the items.
     *
     * @param array $items
     * @return $this
     */
    public function setItems(array $items)
    {
        $this->setRequestBodyParameter('items', $items);

        return $this;
    }

    /**
     *
     * @return boolean|null
     */
    public function isManual()
    {
        return $this->getRequestBodyParameter('manual');
    }

    /**
     * @param $manual
     * @return $this
     */
    public function setManual($manual)
    {
        $this->setRequestBodyParameter('manual', $manual);

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDaysActive()
    {
        return $this->getRequestBodyParameter('days_active');
    }

    /**
     * @param $days
     * @return $this
     */
    public function setDaysActive($days)
    {
        $this->setRequestBodyParameter('days_active', $days);

        return $this;
    }

    /**
     * Get the payment options.
     *
     * @return mixed|null
     */
    public function getPaymentOptions()
    {
        return $this->getRequestBodyParameter('payment_options');
    }

    /**
     * Set the payment options.
     *
     * @param array $paymentOptions
     * @return $this
     */
    public function setPaymentOptions(array $paymentOptions)
    {
        // @todo filter array keys.
        // Check of er geen invalid keys in staan.

        $this->setRequestBodyParameter('payment_options', $paymentOptions);

        return $this;
    }

    /**
     * Get the customer details.
     *
     * @return mixed|null
     */
    public function getCustomer()
    {
        return $this->getRequestBodyParameter('customer');
    }

    /**
     * Set the customer details.
     *
     * @param array $customer
     * @return $this
     */
    public function setCustomer(array $customer)
    {
        $this->setRequestBodyParameter('customer', $customer);

        return $this;
    }
}
