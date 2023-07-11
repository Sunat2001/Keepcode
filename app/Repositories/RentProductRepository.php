<?php

namespace App\Repositories;

use App\Models\RentProduct;

class RentProductRepository implements RentProductRepositoryInterface
{
    /**
     * @param string $user_id
     * @param string $product_id
     * @return RentProduct
     */
    public function getRentProductByProductAndUser(string $user_id, string $product_id): RentProduct {
        return RentProduct::query()
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->get();
    }

    /**
     * @param RentProduct $rentProduct
     * @param array $fields
     * @return void
     */
    public function updateRentProduct(RentProduct $rentProduct, array $fields): void
    {
        $rentProduct->update($fields);
    }
}
