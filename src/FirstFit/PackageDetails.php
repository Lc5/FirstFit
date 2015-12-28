<?php

namespace Lc5\FirstFit;

/**
 * Class PackageDetails
 *
 * @author Łukasz Krzyszczak <lukasz.krzyszczak@gmail.com>
 */
class PackageDetails
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
     * @param int $width
     * @param int $height
     * @param int $depth
     * @param int $weight
     * @param int $maxWeight
     */
    public function __construct($width, $height, $depth, $weight = null, $maxWeight = null)
    {
        $this->width     = $width;
        $this->height    = $height;
        $this->depth     = $depth;
        $this->weight    = $weight;
        $this->maxWeight = $maxWeight;
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
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * @return int
     */
    public function getMaxWeight()
    {
        return $this->maxWeight;
    }
}
