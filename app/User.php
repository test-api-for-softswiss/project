<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /** @var string */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'amount'
    ];

    public function addAmount($amount)
    {
        $this->amount += $amount;
    }

    public function subAmount($amount)
    {
        if ($this->amount < $amount) {
            throw new \InvalidArgumentException('The amount to subtract could not be greater than current balance');
        }
        $this->amount -= $amount;
    }
}
