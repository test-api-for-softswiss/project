<?php
/**
 * Author: Anton Orlov
 * Date: 10.10.2017
 * Time: 23:07
 */

namespace App\Presenters;


use App\User;

class Balance implements PresenterInterface
{
    /**
     * @param User $object
     * @return array
     */
    public function getResponse($object)
    {
        return [
            'user' => $object->id,
            'balance' => $object->amount
        ];
    }
}