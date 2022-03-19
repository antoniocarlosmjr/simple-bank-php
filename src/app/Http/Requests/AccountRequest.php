<?php

namespace App\Http\Requests;

use Pearl\RequestValidate\RequestAbstract;

class AccountRequest extends RequestAbstract
{
    public function rules(): array
    {
        return [
            'account_id' => 'required|integer',
        ];
    }
}
