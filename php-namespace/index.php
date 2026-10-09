<?php

require_once __DIR__ . '/vendor/autoload.php';

use Src\Services\UserService;
use Src\Services\ProductService;

try {
    $userService = new UserService();
    $user = $userService->createUser(
        'Budi',
        'budi@example.com'
    );

    echo $userService->displayUser($user) . '<br><br>';

    $productService = new ProductService();

    $product1 = $productService->createProduct(
        'Laptop',
        7500000.0
    );

    $product2 = $productService->createProduct(
        'Mouse Wireless',
        150000.0
    );

    echo $productService->displayProduct($product1) . '<br>';
    echo $productService->displayProduct($product2);
} catch (Throwable $e) {
    echo '<h3>Terjadi Error</h3>';
    echo '<p>Pesan: ' . $e->getMessage() . '</p>';
    echo '<p>File: ' . $e->getFile() . '</p>';
    echo '<p>Line: ' . $e->getLine() . '</p>';
}
