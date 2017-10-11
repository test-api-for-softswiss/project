<?php

namespace App\Http\Requests;


class DepositRequest extends UnauthorizedRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user' => 'required|integer|min:1',
            'amount' => 'required|integer|min:1'
        ];
    }
}
