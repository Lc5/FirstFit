<?php

namespace Lc5\FirstFit;

/**
 * Class ItemTest
 *
 * @author Łukasz Krzyszczak <lukasz.krzyszczak@gmail.com>
 */
class ItemTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $item = new Item(123, 456, 789, 321);

        $this->assertSame(123, $item->getWidth());
        $this->assertSame(456, $item->getHeight());
        $this->assertSame(789, $item->getDepth());
        $this->assertSame(321, $item->getWeight());
    }

    public function testGetVolume()
    {
        $item = new Item(1, 2, 3, 321);

        $this->assertSame(6, $item->getVolume());
    }
}
