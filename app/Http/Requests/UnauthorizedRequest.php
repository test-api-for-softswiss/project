<?php
/**
 * Author: Anton Orlov
 * Date: 10.10.2017
 * Time: 06:45
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

abstract class UnauthorizedRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}