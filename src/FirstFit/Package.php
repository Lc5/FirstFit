<?php

namespace Lc5\FirstFit;

/**
 * Class Package
 *
 * @author Łukasz Krzyszczak <lukasz.krzyszczak@gmail.com>
 */
class Package
{

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @var int
     */
    private $depth;

    /**
     * @var int
     */
    private $weight;

    /**
     * @var int
     */
    private $maxWeight;

    /**
     * @var array
     */
    private $items = [];

    /**
     * @param PackageDetails $packageDetails
     */
    public function __construct(PackageDetails $packageDetails)
    {
        $this->width     = $packageDetails->getWidth();
        $this->height    = $packageDetails->getHeight();
        $this->depth     = $packageDetails->getDepth();
        $this->weight    = $packageDetails->getWeight();
        $this->maxWeight = $packageDetails->getMaxWeight();
    }

    /**
     * @return int
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @return int
     */
    public function getMaxWeight()
    {
        return $this->maxWeight;
    }

    /**
     * @return int
     */
    public function getVolume()
    {
        return $this->width * $this->height * $this->depth;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function getItemsVolume()
    {
        $itemsVolume = 0;

        foreach ($this->items as $item) {
            $itemsVolume += $item->getVolume();
        }

        return $itemsVolume;
    }

    /**
     * @return int
     */
    public function getItemsWeight()
    {
        $itemsWeight = 0;

        foreach ($this->items as $item) {
            $itemsWeight += $item->getWeight();
        }

        return $itemsWeight;
    }

    /**
     * @return int
     */
    public function getTotalWeight()
    {
        return $this->getWeight() + $this->getItemsWeight();
    }

    /**
     * @param Item $item
     * @return $this
     */
    public function addItem(Item $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return count($this->items) === 0;
    }
}
