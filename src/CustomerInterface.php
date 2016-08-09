<?php namespace Ntholenaar\MultiSafepayClient;

interface CustomerInterface
{
    /**
     * Get the locale.
     *
     * @return string
     */
    public function getLocale();

    /**
     * Set the locale.
     *
     * @param string $locale
     * @return Customer
     */
    public function setLocale($locale);

    /**
     * Get the ip address.
     *
     * @return string
     */
    public function getIpAddress();

    /**
     * Set the ip address.
     *
     * @param string $ipAddress
     * @return Customer
     * @throws \InvalidArgumentException when the given ip address is invalid.
     */
    public function setIpAddress($ipAddress);

    /**
     * Get the first name.
     *
     * @return string
     */
    public function getFirstName();

    /**
     * Set the first name.
     *
     * @param string $firstName
     * @return Customer
     */
    public function setFirstName($firstName);

    /**
     * Get the last name.
     *
     * @return string
     */
    public function getLastName();

    /**
     * Set the last name.
     *
     * @param string $lastName
     * @return Customer
     */
    public function setLastName($lastName);

    /**
     * Get the address.
     *
     * @return string
     */
    public function getAddress1();

    /**
     * Set the address.
     *
     * @param string $address1
     * @return Customer
     */
    public function setAddress1($address1);

    /**
     * Get the address.
     *
     * @return string
     */
    public function getAddress2();

    /**
     * Set the address.
     *
     * @param string $address2
     * @return Customer
     */
    public function setAddress2($address2);

    /**
     * Get the house number.
     *
     * @return string
     */
    public function getHouseNumber();

    /**
     * Set the house number.
     *
     * @param string $houseNumber
     * @return Customer
     */
    public function setHouseNumber($houseNumber);

    /**
     * Get the zip code.
     *
     * @return string
     */
    public function getZipCode();

    /**
     * Set the zip code.
     *
     * @param string $zipCode
     * @return Customer
     */
    public function setZipCode($zipCode);

    /**
     * Get the city.
     *
     * @return string
     */
    public function getCity();

    /**
     * Set the city.
     *
     * @param string $city
     * @return Customer
     */
    public function setCity($city);

    /**
     * Get the state.
     *
     * @return string
     */
    public function getState();

    /**
     * Set the state.
     *
     * @param string $state
     * @return Customer
     */
    public function setState($state);

    /**
     * Get the country.
     *
     * @return string
     */
    public function getCountry();

    /**
     * Set the country.
     *
     * @param string $country
     * @return Customer
     */
    public function setCountry($country);

    /**
     * Get the phone number.
     *
     * @return string
     */
    public function getPhoneNumber();

    /**
     * Set the phone number.
     *
     * @param string $phoneNumber
     * @return Customer
     */
    public function setPhoneNumber($phoneNumber);

    /**
     * Get the e-mail address.
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set the e-mail address.
     *
     * @param string $email
     * @return Customer
     */
    public function setEmail($email);
}
