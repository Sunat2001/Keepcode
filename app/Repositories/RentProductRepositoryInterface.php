<?php

namespace App\Repositories;

use App\Models\RentProduct;

interface RentProductRepositoryInterface
{
    /**
     * @param string $user_id
     * @param string $product_id
     * @return RentProduct
     */
    public function getRentProductByProductAndUser(string $user_id, string $product_id): RentProduct;

    /**
     * @param RentProduct $rentProduct
     * @param array $fields
     * @return void
     */
    public function updateRentProduct(RentProduct $rentProduct, array $fields): void;
}
