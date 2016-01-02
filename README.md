# FirstFit
First-fit decreasing algorithm implementation.

The following implementation aims to solve the problem of packing rectangle items into the smallest possible number of 
fixed size rectangle packages. The items are initially sorted descending by volume (hence the "decreasing" in the algorithm
name). For each item, it attempts to place the item in the first package it fits. If no fitting package is found, it 
creates a new package and tries to put the item into the new package. If the item won't fit into the empty package the 
algorithm will fail.

The implementation utilises the Strategy design pattern by extracting the fitting logic into it's own class implementing
```FittingStrategyInterface```. Currently only naive ```Liquid``` strategy is implemented, which only checks the volume
and the weight of an item. 

What can be it used for? For example, when calculating the estimated delivery cost in an online shop. Please bear in mind,
that this is the research project and for real-life usage more sophisticated fitting strategy should be implemented.

More info: [Bin packing problem]

## Installation

```
$ git clone https://github.com/Lc5/FirstFit.git
$ cd FirstFit
$ composer install
```

## Usage

```php
use Lc5\FirstFit\Item;
use Lc5\FirstFit\FirstFit;
use Lc5\FirstFit\FittingStrategy;
use Lc5\FirstFit\PackageDetails;

$packageDetails = new PackageDetails(10, 10, 10, 1, 10);
$item1 = new Item(2, 2, 2, 2);
$item2 = new Item(1, 1, 1, 1);

$firstFit = new FirstFit(new FittingStrategy\Liquid());
$packages = $firstFit->pack([$item1, $item2], $packageDetails);

// count($packages) === 1;
// reset($packages)->getItems()) === [$item1, $item2];
```
    
[Bin packing problem]: https://en.wikipedia.org/wiki/Bin_packing_problem
