<?php

namespace Lc5\FirstFit;

use Lc5\FirstFit\FittingStrategy\FittingStrategyInterface;

/**
 * Class FirstFit
 *
 * @author Łukasz Krzyszczak <lukasz.krzyszczak@gmail.com>
 */
class FirstFit
{

    /**
     * @var FittingStrategyInterface
     */
    private $fittingStrategy;

    /**
     * @param FittingStrategyInterface $fittingStrategy
     */
    public function __construct(FittingStrategyInterface $fittingStrategy)
    {
        $this->fittingStrategy = $fittingStrategy;
    }


    /**
     * @param array $items
     * @param PackageDetails $packageDetails
     * @return array|bool
     */
    public function pack(array $items, PackageDetails $packageDetails)
    {
        $packages = [];

        $this->sortByVolumeDesc($items);

        foreach ($items as $item) {
            if (count($packages) === 0) {
                $packages[] = new Package($packageDetails);
            }

            $packed = false;

            foreach ($packages as $package) {
                if ($this->fits($item, $package)) {
                    $package->addItem($item);
                    $packed = true;
                    break;
                } else if ($package->isEmpty()) {
                    return false;
                }
            }

            if (!$packed) {
                $newPackage = new Package($packageDetails);
                $packages[] = $newPackage;

                if ($this->fits($item, $newPackage)) {
                    $newPackage->addItem($item);
                } else {
                    return false;
                }
            }
        }

        return $packages;
    }

    /**
     * @param array $items
     */
    private function sortByVolumeDesc(array &$items)
    {
        usort($items, function(Item $itemOne, Item $itemTwo) {
            return $itemTwo->getVolume() - $itemOne->getVolume();
        });
    }

    /**
     * @param Item $item
     * @param Package $package
     * @return bool
     */
    private function fits(Item $item, Package $package)
    {
        return $this->fittingStrategy->fits($item, $package);
    }
}
