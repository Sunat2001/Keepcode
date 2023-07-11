<?php

namespace App\Services;

use App\Models\Product;
use App\Models\RentProduct;
use App\Models\User;
use App\Repositories\RentProductRepositoryInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ExtendRentPeriodService
{
    public function __construct(
        private RentProductRepositoryInterface $rentProductRepository,
    ){}

    /**
     * @param User $user
     * @param Product $product
     * @param int $extendPeriod
     * @return string
     */
    public function extend(User $user, Product $product, int $extendPeriod): string
    {
        $rentProduct = $this->rentProductRepository->getRentProductByProductAndUser($user->id, $product->id);

        $rentalTime = Carbon::parse($rentProduct->expired_at);

        $rentalTime->addHours($extendPeriod);

        $currentTime = Carbon::now();

        $maxRentalTime = $currentTime->copy()->addHours(24);
        if ($rentalTime > $maxRentalTime) {
            $rentalTime = $maxRentalTime;
        }

        $this->rentProductRepository->updateRentProduct($rentProduct, [
            'expired_at' => $rentalTime,
        ]);

        return $rentalTime->format('Y-m-d H:i:s');
    }
}
