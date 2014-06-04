<?php

namespace Jaydean\Claredale\Sync\Objects;

class Product
{
    protected $id;
    protected $sku;
    protected $barcode;
    protected $name;
    protected $category;
    protected $brand;
    protected $manufacturer;
    protected $price;
    protected $gst;
    protected $show;
    protected $image;
    protected $thumb;
    protected $description;
    protected $updated;

    /**
     * @param array $productData
     */
    public function __construct($productData = [])
    {
        if (isset($productData['id'])) {
            $this->id = $productData['id'];
        }

        foreach ($productData as $productKey => $productValue) {
            $methodName = 'set' . ucfirst($productKey);
            if (method_exists($this, $methodName)) {
                $this->$methodName($productValue);
            }
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return string
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * @param string $barcode
     */
    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
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
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param Brand $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return Manufacturer
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * @param Manufacturer $manufacturer
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return bool
     */
    public function getGst()
    {
        return $this->gst;
    }

    /**
     * @param bool $gst
     */
    public function setGst($gst)
    {
        $this->gst = $gst;
    }

    /**
     * @return bool
     */
    public function getShow()
    {
        return $this->show;
    }

    /**
     * @param bool $show
     */
    public function setShow($show)
    {
        $this->show = $show;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * @param string $thumb
     */
    public function setThumb($thumb)
    {
        $this->thumb = $thumb;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     */
    public function setUpdated($updated)
    {
        if (is_string($updated)) {
            $updated = new \DateTime($updated);
        }
        $this->updated = $updated;
    }
}