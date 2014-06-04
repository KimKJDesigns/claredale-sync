<?php

include_once __DIR__ . '/../vendor/autoload.php';

use Jaydean\Claredale\Sync\Manager;

$token = 'YOUR-TOKEN';

$syncManager = new Manager($token);

$syncManager->addEvent(
    'getCategory',
    function ($category) {
        echo 'Category ' . $category->getName() . ' was added.' . PHP_EOL;
    }
);

$syncManager->addEvent(
    'getBrand',
    function ($brand) {
        echo 'Brand ' . $brand->getName() . ' was added.' . PHP_EOL;
    }
);

$syncManager->addEvent(
    'getManufacturer',
    function ($manufacturer) {
        echo 'Manufacturer ' . $manufacturer->getName() . ' was added.' . PHP_EOL;
    }
);

$syncManager->addEvent(
    'getProduct',
    function ($product) {
        echo 'Product ' . $product->getName() . ' was added.' . PHP_EOL;
    }
);

$syncManager->startSync();