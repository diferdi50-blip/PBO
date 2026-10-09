<?php

namespace Src\Services;

use Src\Models\Product;

class ProductService
{
    public function createProduct(string $name, float $price): Product
    {
        return new Product($name, $price);
    }

    public function displayProduct(Product $product): string
    {
        return $product->getName()
            . ' - '
            . $product->getFormattedPrice();
    }
}
