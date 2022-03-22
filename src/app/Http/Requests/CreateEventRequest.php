<?php

namespace App\Http\Requests;

use App\Enumerators\EventTypesEnum;
use Pearl\RequestValidate\RequestAbstract;

class CreateEventRequest extends RequestAbstract
{
    public function rules(): array
    {
        return [
            'type' => 'required|string|in:' . EventTypesEnum::getFieldsList(),
            'destination' => [
                'string',
                'required_if:type,' . EventTypesEnum::DEPOSIT,
                'required_if:type,' . EventTypesEnum::TRANSFER,
            ],
            'origin' => [
                'string',
                'required_if:type,' . EventTypesEnum::WITHDRAW,
                'required_if:type,' . EventTypesEnum::TRANSFER,
            ],
            'amount' => 'required|numeric|min:0.1'
        ];
    }
}
