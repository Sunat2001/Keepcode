<?php

namespace App\Http\Requests;

use App\Enum\RentHourPeriods;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'period' => ['required', Rule::in(RentHourPeriods::getValues())],
        ];
    }
}
