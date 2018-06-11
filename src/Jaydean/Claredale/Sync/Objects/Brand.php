<?php

namespace Jaydean\Claredale\Sync\Objects;

class Brand
{
    protected $id;
    protected $name;
    protected $manufacturer;

    public function __construct($id, $name, $manufacturer)
    {
        $this->id = $id;
        $this->name = $name;
        $this->manufacturer = $manufacturer;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * @param string $name
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }
}
