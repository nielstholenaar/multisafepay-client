<?php namespace Ntholenaar\MultiSafepayClient;

interface GatewayInterface
{
    /**
     * Get the identifier.
     *
     * @return string
     */
    public function getId();

    /**
     * Set the identifier.
     *
     * @param $id
     * @return $this
     */
    public function setId($id);

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
