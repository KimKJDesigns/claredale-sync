<?php

namespace Jaydean\Claredale\Sync\Objects;

class Category
{
    protected $id;
    protected $name;
    protected $parentCategory;

    /**
     * @param string $id
     * @param string $name
     * @param Category $parentCategory
     */
    public function __construct($id, $name, $parentCategory = null)
    {
        $this->id = $id;
        $this->name = $name;
        if ($parentCategory !== null) {
            $this->setParentCategory($parentCategory);
        }
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param Category $parentCategory
     */
    public function setParentCategory($parentCategory)
    {
        if (!($parentCategory instanceof Category)) {
            throw new \BadMethodCallException('$parentCategory must be a Category');
        }
        $this->parentCategory = $parentCategory;
    }

    /**
     * @return Category
     */
    public function getParentCategory()
    {
        return $this->parentCategory;
    }
}