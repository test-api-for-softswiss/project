<?php
/**
 * Author: Anton Orlov
 * Date: 11.10.2017
 * Time: 00:37
 */

namespace App\Presenters;


use App\Transaction;

class Transfer implements PresenterInterface
{
    /** @var Balance */
    private $balance;

    public function __construct()
    {
        $this->balance = new Balance();
    }

    /**
     * @param Transaction $object
     * @return array
     */
    public function getResponse($object)
    {
        return [
            'sender' => $this->balance->getResponse($object->sender),
            'recipient' => $this->balance->getResponse($object->recipient)
        ];
    }
}