<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $guarded = [];

    public function messages() {
        return $this->hasMany(Message::class);
    }

    public function getReceiver() {
        if($this->sender_id == auth()->id()) {
            return User::where('id', $this->receiver_id)->first();
        } else {
            return User::where('id', $this->sender_id)->first();
        }
    }
}
