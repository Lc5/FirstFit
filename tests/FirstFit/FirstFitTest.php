<?php

namespace Lc5\FirstFit;

/**
 * Class FirstFitTest
 *
 * @author Łukasz Krzyszczak <lukasz.krzyszczak@gmail.com>
 */
class FirstFitTest extends \PHPUnit_Framework_TestCase
{

    public function testPackNoItems()
    {
        $fittingStrategy = $this->getMock('Lc5\FirstFit\FittingStrategy\FittingStrategyInterface');
        $packageDetails = $this->getMock('Lc5\FirstFit\PackageDetails', [], [], '', false);

        $firstFit = new FirstFit($fittingStrategy);

        $this->assertSame([], $firstFit->pack([], $packageDetails));
    }

    public function testPackNotFittingItem()
    {
        $fittingStrategy = $this->getMock('Lc5\FirstFit\FittingStrategy\FittingStrategyInterface');
        $packageDetails = $this->getMock('Lc5\FirstFit\PackageDetails', [], [], '', false);
        $item = $this->getMock('Lc5\FirstFit\Item', [], [], '', false);

        $fittingStrategy
            ->expects($this->once())
            ->method('fits')
            ->with($item, $this->isInstanceOf('Lc5\FirstFit\Package'))
            ->will($this->returnValue(false));

        $firstFit = new FirstFit($fittingStrategy);

        $this->assertFalse($firstFit->pack([$item], $packageDetails));
    }

    public function testPackOneFittingItem()
    {
        $fittingStrategy = $this->getMock('Lc5\FirstFit\FittingStrategy\FittingStrategyInterface');
        $packageDetails = $this->getMock('Lc5\FirstFit\PackageDetails', [], [], '', false);
        $item = $this->getMock('Lc5\FirstFit\Item', [], [], '', false);

        $fittingStrategy
            ->expects($this->once())
            ->method('fits')
            ->with($item, $this->isInstanceOf('Lc5\FirstFit\Package'))
            ->will($this->returnValue(true));

        $firstFit = new FirstFit($fittingStrategy);
        $packages = $firstFit->pack([$item], $packageDetails);

        $this->assertCount(1, $packages);
        $this->assertSame([$item], reset($packages)->getItems());
    }

    public function testPackTwoFittingItems()
    {
        $fittingStrategy = $this->getMock('Lc5\FirstFit\FittingStrategy\FittingStrategyInterface');
        $packageDetails = $this->getMock('Lc5\FirstFit\PackageDetails', [], [], '', false);
        $item1 = $this->getMock('Lc5\FirstFit\Item', [], [], '', false);
        $item2 = $this->getMock('Lc5\FirstFit\Item', [], [], '', false);

        $fittingStrategy
            ->expects($this->any())
            ->method('fits')
            ->will($this->returnValue(true));

        $firstFit = new FirstFit($fittingStrategy);
        $packages = $firstFit->pack([$item1, $item2], $packageDetails);

        $this->assertCount(1, $packages);
        $this->assertSameSorted([$item1, $item2], reset($packages)->getItems());
    }

    public function testPackAddsPackages()
    {
        $fittingStrategy = $this->getMock('Lc5\FirstFit\FittingStrategy\FittingStrategyInterface');
        $packageDetails = $this->getMock('Lc5\FirstFit\PackageDetails', [], [], '', false);
        $item1 = $this->getMock('Lc5\FirstFit\Item', [], [], '', false);
        $item2 = $this->getMock('Lc5\FirstFit\Item', [], [], '', false);

        $item1->expects($this->any())->method('getVolume')->will($this->returnValue(100));
        $item1->expects($this->any())->method('getVolume')->will($this->returnValue(10));

        $fittingStrategy
            ->expects($this->at(0))
            ->method('fits')
            ->with($item1, $this->isInstanceOf('Lc5\FirstFit\Package'))
            ->will($this->returnValue(true));

        $fittingStrategy
            ->expects($this->at(1))
            ->method('fits')
            ->with($item2, $this->isInstanceOf('Lc5\FirstFit\Package'))
            ->will($this->returnValue(false));

        $fittingStrategy
            ->expects($this->at(2))
            ->method('fits')
            ->with($item2, $this->isInstanceOf('Lc5\FirstFit\Package'))
            ->will($this->returnValue(true));

        $firstFit = new FirstFit($fittingStrategy);
        $packages = $firstFit->pack([$item1, $item2], $packageDetails);

        $this->assertCount(2, $packages);
        $this->assertSame([$item1], reset($packages)->getItems());
        $this->assertSame([$item2], end($packages)->getItems());
    }

    public function testPackSortsByVolumeDesc()
    {
        $fittingStrategy = $this->getMock('Lc5\FirstFit\FittingStrategy\FittingStrategyInterface');
        $packageDetails = $this->getMock('Lc5\FirstFit\PackageDetails', [], [], '', false);

        $smallItem = $this->getMock('Lc5\FirstFit\Item', [], [], '', false);
        $mediumItem = $this->getMock('Lc5\FirstFit\Item', [], [], '', false);
        $bigItem = $this->getMock('Lc5\FirstFit\Item', [], [], '', false);

        $smallItem->expects($this->any())->method('getVolume')->will($this->returnValue(10));
        $mediumItem->expects($this->any())->method('getVolume')->will($this->returnValue(100));
        $bigItem->expects($this->any())->method('getVolume')->will($this->returnValue(1000));

        $fittingStrategy
            ->expects($this->any())
            ->method('fits')
            ->will($this->returnValue(true));

        $items = [$smallItem, $mediumItem, $bigItem];
        shuffle($items);

        $firstFit = new FirstFit($fittingStrategy);
        $packages = $firstFit->pack($items, $packageDetails);

        $this->assertCount(1, $packages);
        $this->assertSame([$bigItem, $mediumItem, $smallItem], reset($packages)->getItems());
    }

    /**
     * @param array $array1
     * @param array $array2
     */
    private function assertSameSorted(array $array1, array $array2)
    {
        usort($array1, [$this, 'compareObjects']);
        usort($array2, [$this, 'compareObjects']);

        $this->assertSame($array1, $array2);
    }

    /**
     * @param object $object1
     * @param object $object2
     * @return int
     */
    private function compareObjects($object1, $object2)
    {
        return strcmp(spl_object_hash($object1), spl_object_hash($object2));
    }
}
