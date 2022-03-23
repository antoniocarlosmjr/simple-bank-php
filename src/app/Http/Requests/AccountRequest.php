<?php

namespace App\Http\Requests;

use Pearl\RequestValidate\RequestAbstract;

/**
 *   @OA\Schema(
 *       schema="AccountRequest",
 *       required={"account_id"},
 *       @OA\Property(
 *           property="account_id",
 *           type="integer"
 *       ),
 *       example={
 *           "account_id": 55
 *       }
 *   )
 */
class AccountRequest extends RequestAbstract
{
    public function rules(): array
    {
        return [
            'account_id' => 'required|integer',
        ];
    }
}
