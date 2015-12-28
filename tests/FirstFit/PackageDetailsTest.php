<?php

namespace Lc5\FirstFit;

/**
 * Class PackageDetailsTest
 *
 * @author Łukasz Krzyszczak <lukasz.krzyszczak@gmail.com>
 */
class PackageDetailsTest extends \PHPUnit_Framework_TestCase
{

    public function testConstruct()
    {
        $packageDetails = new PackageDetails(123, 456, 789, 321, 654);

        $this->assertSame(123, $packageDetails->getWidth());
        $this->assertSame(456, $packageDetails->getHeight());
        $this->assertSame(789, $packageDetails->getDepth());
        $this->assertSame(321, $packageDetails->getWeight());
        $this->assertSame(654, $packageDetails->getMaxWeight());
    }
}
