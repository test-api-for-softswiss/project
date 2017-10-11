<?php
/**
 * Author: Anton Orlov
 * Date: 10.10.2017
 * Time: 22:45
 */

namespace App\Services;


use App\Transaction;
use App\User;

class AccountingService
{
    /**
     * @param int $id
     * @return User|null
     */
    public function getUserBalanceById(int $id)
    {
        return User::find($id);
    }

    /**
     * @param int $id
     * @param int $amount
     * @return User
     */
    public function depositUserById(int $id, int $amount)
    {
        \DB::beginTransaction();
        $txn = new Transaction();
        $txn->deposit($this->findOrCreateUserById($id), $amount);
        $txn->push();
        \DB::commit();

        return $txn->recipient;
    }

    /**
     * @param int $id
     * @param int $amount
     * @return User|null
     */
    public function withdrawUserById(int $id, int $amount)
    {
        \DB::beginTransaction();
        $txn = new Transaction();
        $txn->withdraw($this->findUserById($id), $amount);
        $txn->push();
        \DB::commit();

        return $txn->sender;
    }

    /**
     * @param int $sender
     * @param int $recipient
     * @param int $amount
     * @return Transaction
     */
    public function transferByUserId(int $sender, int $recipient, int $amount)
    {
        \DB::beginTransaction();
        $txn = new Transaction();
        $txn->transfer($this->findUserById($sender), $this->findUserById($recipient), $amount);
        $txn->push();
        \DB::commit();

        return $txn;
    }

    /**
     * @param int $userId
     * @return User
     */
    private function findUserById(int $userId)
    {
        return User::where('id', '=', $userId)->lockForUpdate()->get()->first();
    }

    /**
     * @param int $userId
     * @return User
     */
    private function findOrCreateUserById(int $userId)
    {
        if (!($result = $this->findUserById($userId))) {
            $result = new User(['id' => $userId, 'amount' => 0]);
        }
        return $result;
    }
}