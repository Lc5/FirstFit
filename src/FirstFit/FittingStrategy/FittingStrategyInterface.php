<?php

namespace Lc5\FirstFit\FittingStrategy;

use Lc5\FirstFit\Item;
use Lc5\FirstFit\Package;

/**
 * Interface FittingStrategyInterface
 *
 * @author Łukasz Krzyszczak <lukasz.krzyszczak@gmail.com>
 */
interface FittingStrategyInterface
{

    /**
     * @param Item $item
     * @param Package $package
     * @return bool
     */
    public function fits(Item $item, Package $package);
}
