<?php

namespace Lc5\FirstFit;

/**
 * Class PackageTest
 *
 * @author Łukasz Krzyszczak <lukasz.krzyszczak@gmail.com>
 */
class PackageTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Package
     */
    private $package;

    protected function setUp()
    {
        parent::setUp();

        $this->package = new Package(new PackageDetails(123, 456, 789, 321, 654));
    }

    public function testConstruct()
    {
        $this->assertSame(123, $this->package->getWidth());
        $this->assertSame(456, $this->package->getHeight());
        $this->assertSame(789, $this->package->getDepth());
        $this->assertSame(321, $this->package->getWeight());
        $this->assertSame(654, $this->package->getMaxWeight());
    }

    public function testGetVolume()
    {
        $this->assertSame(44253432, $this->package->getVolume());
    }

    public function testAddItem()
    {
        $itemOne = new Item(1, 2, 3, 50);
        $itemTwo = new Item(4, 5, 6, 60);

        $this->package
            ->addItem($itemOne)
            ->addItem($itemTwo);

        $this->assertEquals([$itemOne, $itemTwo], $this->package->getItems());
    }

    public function testGetItemsVolume()
    {
        $this->package
            ->addItem(new Item(1, 2, 3, 50))
            ->addItem(new Item(4, 5, 6, 60));

        $this->assertSame(126, $this->package->getItemsVolume());
    }

    public function testGetItemsWeight()
    {
        $this->package
            ->addItem(new Item(1, 2, 3, 50))
            ->addItem(new Item(4, 5, 6, 60));

        $this->assertSame(110, $this->package->getItemsWeight());
    }

    public function testGetTotalWeight()
    {
        $this->package
            ->addItem(new Item(1, 2, 3, 50))
            ->addItem(new Item(4, 5, 6, 60));

        $this->assertSame(431, $this->package->getTotalWeight());
    }

    public function testIsEmpty()
    {
        $this->assertTrue($this->package->isEmpty());

        $this->package->addItem(new Item(1, 2, 3, 50));

        $this->assertFalse($this->package->isEmpty());

    }
}
