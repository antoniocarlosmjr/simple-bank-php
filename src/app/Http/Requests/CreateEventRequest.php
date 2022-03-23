<?php

namespace App\Http\Requests;

use App\Enumerators\EventTypesEnum;
use Pearl\RequestValidate\RequestAbstract;

/**
 *   @OA\Schema(
 *       schema="CreateEventRequest",
 *       required={"type", "amount"},
 *       @OA\Property(
 *           property="type",
 *           type="integer",
 *           enum={"deposit", "withdraw", "transfer"}
 *       ),
 *       @OA\Property(
 *           property="destination",
 *           type="string",
 *           description="required if type is deposit or transfer"
 *       ),
 *       @OA\Property(
 *           property="origin",
 *           type="string",
 *           description="required if type is withdraw or transfer"
 *       ),
 *       @OA\Property(
 *           property="amount",
 *           type="float"
 *       ),
 *       example={
 *           "type": "deposit",
 *           "destination": "10",
 *           "amount": 50
 *       }
 *   )
 */
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
