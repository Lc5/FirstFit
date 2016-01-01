<?php

namespace Lc5\FirstFit\FittingStrategy;

use Lc5\FirstFit\Item;
use Lc5\FirstFit\Package;

/**
 * Class Liquid
 *
 * @author Łukasz Krzyszczak <lukasz.krzyszczak@gmail.com>
 */
class Liquid implements FittingStrategyInterface
{

    public function fits(Item $item, Package $package)
    {
        if ($package->getMaxWeight() !== null &&
            $package->getTotalWeight() + $item->getWeight() > $package->getMaxWeight()) {
            return false;
        }

        if ($package->getItemsVolume() + $item->getVolume() > $package->getVolume()) {
            return false;
        }

        return true;
    }
}
