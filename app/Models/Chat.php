<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['seen'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receiverProfile() : BelongsTo {
        return $this->belongsTo(User::class, 'receiver_id', 'id')
            ->select(['id', 'image', 'name'])->with('vendor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function senderProfile() : BelongsTo {
        return $this->belongsTo(User::class, 'sender_id', 'id')
            ->select(['id', 'image', 'name'])->with('vendor');
    }
}
