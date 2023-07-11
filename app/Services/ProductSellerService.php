<?php

namespace App\Services;

use App\Enum\ProductStatuses;
use App\Models\Product;
use App\Models\SoldProduct;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductSellerService
{
    public function sell(Product $product, User $user): void
    {
        DB::beginTransaction();
        try {
            SoldProduct::query()->create([
                'user_id'    => $user->id,
                'product_id' => $product->id,
            ]);

            $product->status = ProductStatuses::SOLD;
            $product->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage() . "\n" . $e->getTraceAsString());

            response()->json(['message' => 'Product was not sold'], 400);
        }

    }
}
