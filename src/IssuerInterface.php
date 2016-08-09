<?php namespace Ntholenaar\MultiSafepayClient;

interface IssuerInterface
{
    /**
     * Get the code.
     *
     * @return int
     */
    public function getCode();

    /**
     * Set the code.
     *
     * @param $code
     * @return $this
     */
    public function setCode($code);

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set the description.
     *
     * @param $description
     * @return $this
     */
    public function setDescription($description);
}
