<?php namespace Ntholenaar\MultiSafepayClient;

class Order
{
    protected $type;
    protected $orderId;
    protected $currency;
    protected $amount;
    protected $description;

    /**
     * @var Gateway
     */
    protected $gateway;

    protected $var1;
    protected $var2;
    protected $var3;
    protected $items;
    protected $manual;
    protected $daysActive;
    protected $notificationUrl;
    protected $redirectUrl;
    protected $cancelUrl;
    protected $closeWindow;

    /**
     * @var Customer
     */
    protected $customer;
}
