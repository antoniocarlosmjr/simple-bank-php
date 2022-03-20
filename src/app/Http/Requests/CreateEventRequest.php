<?php

namespace App\Http\Requests;

use App\Enumerators\TransactionTypesEnum;
use Pearl\RequestValidate\RequestAbstract;

class CreateEventRequest extends RequestAbstract
{
    public function rules(): array
    {
        return [
            'type' => 'required|string|in:' . TransactionTypesEnum::getFieldsList(),
            'destination' => [
                'string',
                'required_if:type,' . TransactionTypesEnum::DEPOSIT,
                'required_if:type,' . TransactionTypesEnum::TRANSFER
            ],
            'origin' => [
                'string',
                'required_if:type,' . TransactionTypesEnum::WITHDRAW,
                'required_if:type,' . TransactionTypesEnum::TRANSFER
            ],
            'amount' => 'required|numeric|min:1'
        ];
    }
}
