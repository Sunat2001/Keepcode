<?php

namespace App\Http\Controllers;

use App\Enum\ProductStatuses;
use App\Http\Requests\ProductRentRequest;
use App\Models\Product;
use App\Services\ExtendRentPeriodService;
use App\Services\ProductRentalService;
use App\Services\ProductSellerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @param Request $request
     * @param Product $product
     * @return JsonResponse
     */
    public function buy(Request $request, Product $product): JsonResponse {
        $this->checkProductForActive($product);

        /** @var ProductSellerService $service */
        $service = app(ProductSellerService::class);
        $service->sell($product, $request->user());

        return response()->json(['message' => 'Product successfully sold!']);
    }

    public function rent(ProductRentRequest $request, Product $product): JsonResponse {
        $this->checkProductForActive($product);

        /** @var ProductRentalService $service */
        $service = app(ProductRentalService::class);
        $service->rent($product, $request->user(), $request->get('period'));

        return response()->json(['message' => 'Product successfully rented!']);
    }

    public function extendRentPeriod(Request $request, Product $product): JsonResponse {
        $request->validate([
            'period' => ['required', 'integer', 'max:24', 'min:1'],
        ]);

        /** @var ExtendRentPeriodService $service */
        $service = app(ExtendRentPeriodService::class);
        $rentalDateTime = $service->extend($request->user(), $product, $request->get('period'));

        return response()->json([
            "message" => "You rent extended to $rentalDateTime"
        ]);
    }

    private function checkProductForActive(Product $product): void
    {
        if ($product->status != ProductStatuses::ACTIVE) {
            response()->json([
                'message' => 'Product already sold or in rent!'
            ], 400);
        }
    }

}
