<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /** @var string */
    protected $table = 'transaction';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'sender_id', 'recipient_id', 'amount'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id', 'id');
    }

    /**
     * @param User $user
     * @param int $amount
     * @return $this
     */
    public function deposit(User $user, int $amount)
    {
        if (!$this->id) {
            $this->sender()->dissociate();
            $this->recipient()->associate($user);
            $this->amount = $amount;
            $user->addAmount($amount);
        }

        return $this;
    }

    /**
     * @param User $user
     * @param int $amount
     * @return $this
     */
    public function withdraw(User $user, int $amount)
    {
        if (!$this->id) {
            $this->sender()->associate($user);
            $this->recipient()->dissociate();
            $this->amount = $amount;
            $user->subAmount($amount);
        }

        return $this;
    }

    /**
     * @param User $from
     * @param User $to
     * @param int $amount
     */
    public function transfer(User $from, User $to, int $amount)
    {
        if (!$this->id) {
            $this->sender()->associate($from);
            $this->recipient()->associate($to);
            $this->amount = $amount;
            $from->subAmount($amount);
            $to->addAmount($amount);
        }
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }
}
