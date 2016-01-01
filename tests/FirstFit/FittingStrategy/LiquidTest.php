<?php

namespace Lc5\FirstFit;

/**
 * Class LiquidTest
 *
 * @author Łukasz Krzyszczak <lukasz.krzyszczak@gmail.com>
 */
class LiquidTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider fitsDataProvider
     * @param Item $item
     * @param Package $package
     * @param bool $result
     */
    public function testFits(Item $item, Package $package, $result)
    {
        $fittingStrategy = new FittingStrategy\Liquid();

        $this->assertSame($result, $fittingStrategy->fits($item, $package));
    }

    public function fitsDataProvider()
    {
        return [
            [
                new Item(10, 10, 10, 1),
                new Package(new PackageDetails(10, 10, 10)),
                true
            ],
            [
                new Item(9, 9, 9, 1),
                new Package(new PackageDetails(10, 10, 10)),
                true
            ],
            [
                new Item(11, 10, 10, 1),
                new Package(new PackageDetails(10, 10, 10)),
                false
            ],
            [
                new Item(10, 10, 10, 10),
                new Package(new PackageDetails(10, 10, 10, 1, 11)),
                true
            ],
            [
                new Item(10, 10, 10, 9),
                new Package(new PackageDetails(10, 10, 10, 1, 11)),
                true
            ],
            [
                new Item(10, 10, 10, 11),
                new Package(new PackageDetails(10, 10, 10, 1, 11)),
                false
            ]
        ];
    }
}
