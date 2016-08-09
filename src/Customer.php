<?php namespace Ntholenaar\MultiSafepayClient;

class Customer implements CustomerInterface
{
    /**
     * The locale of the customer.
     * Use the format ab_CD with ISO 639 language codes and ISO 3166 country codes.
     *
     * @var string
     */
    protected $locale;

    /**
     * The IP address of the customer.
     *
     * @var string
     */
    protected $ipAddress;

    /**
     * The customer's first name.
     *
     * @var string
     */
    protected $firstName;

    /**
     * The customer's last name.
     *
     * @var string
     */
    protected $lastName;

    /**
     * First line of customer's provided address.
     *
     * @var string
     */
    protected $address1;

    /**
     * Second line of customer's provided address.
     *
     * @var string
     */
    protected $address2;

    /**
     * Customer's provided house number.
     *
     * @var string
     */
    protected $houseNumber;

    /**
     * Customer's provided zip / postal code.
     *
     * @var string
     */
    protected $zipCode;

    /**
     * Customer's provided city.
     *
     * @var string
     */
    protected $city;

    /**
     * Customer's provided state / province.
     *
     * @var string
     */
    protected $state;

    /**
     * Customer's provided country.
     *
     * @var string
     */
    protected $country;

    /**
     * Customer's provided phone number.
     *
     * @var string
     */
    protected $phoneNumber;

    /**
     * Customer's provided email address.
     *
     * @var string
     */
    protected $email;

    /**
     * {@inheritdoc}
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * {@inheritdoc}
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * {@inheritdoc}
     */
    public function setIpAddress($ipAddress)
    {
        if (! filter_var($ipAddress, FILTER_VALIDATE_IP)) {
            throw new \InvalidArgumentException('Invalid ip address provided.');
        }

        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * {@inheritdoc}
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * {@inheritdoc}
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * {@inheritdoc}
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * {@inheritdoc}
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function setHouseNumber($houseNumber)
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * {@inheritdoc}
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * {@inheritdoc}
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * {@inheritdoc}
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * {@inheritdoc}
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}
