<?php

namespace Lc5\FirstFit;

/**
 * Class Item
 *
 * @author Łukasz Krzyszczak <lukasz.krzyszczak@gmail.com>
 */
class Item
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
     * @param int $width
     * @param int $height
     * @param int $depth
     * @param int $weight
     */
    public function __construct($width, $height, $depth, $weight)
    {
        $this->width  = $width;
        $this->height = $height;
        $this->depth  = $depth;
        $this->weight = $weight;
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
    public function getDepth()
    {
        return $this->depth;
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
    public function getVolume()
    {
        return $this->width * $this->height * $this->depth;
    }
}
