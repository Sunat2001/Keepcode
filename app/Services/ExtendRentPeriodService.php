<?php

namespace App\Services;

use App\Models\Product;
use App\Models\RentProduct;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ExtendRentPeriodService
{
    public function extend(User $user, Product $product, int $extendPeriod): string
    {
        $rentProduct = RentProduct::query()
            ->where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->get();

        $rentalTime = Carbon::parse($rentProduct->expired_at);

        $rentalTime->addHours($extendPeriod);

        $currentTime = Carbon::now();

        $maxRentalTime = $currentTime->copy()->addHours(24);
        if ($rentalTime > $maxRentalTime) {
            $rentalTime = $maxRentalTime;
        }

        $rentProduct->expired_at = $rentalTime;
        $rentProduct->save();

        return $rentalTime->format('Y-m-d H:i:s');
    }
}
