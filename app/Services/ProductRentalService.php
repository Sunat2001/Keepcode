<?php

namespace App\Services;

use App\Enum\ProductRentStatuses;
use App\Enum\ProductStatuses;
use App\Models\Product;
use App\Models\RentProduct;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductRentalService
{
    public function rent(Product $product, User $user, int $period): void {
        DB::beginTransaction();
        try {
            DB::commit();

            RentProduct::query()->create([
                'status'     => ProductRentStatuses::ACTIVE,
                'user_id'    => $user->id,
                'product_id' => $product->id,
                'expired_at' => Carbon::now()->addHours($period),
            ]);

            $product->status = ProductStatuses::ON_RENT;
            $product->save();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage() . "\n" . $e->getTraceAsString());

            response()->json(['message' => 'Product was not rented'], 400);
        }
    }
}
