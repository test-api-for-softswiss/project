<?php

namespace App\Http\Requests;


class TransferRequest extends UnauthorizedRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'from' => 'required|integer|min:1',
            'to' => 'required|integer|min:1',
            'amount' => 'required|integer|min:1'
        ];
    }
}
