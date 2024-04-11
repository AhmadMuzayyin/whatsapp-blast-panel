<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WhatsappAccount extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function message_sent(): HasMany
    {
        return $this->hasMany(MessageSent::class);
    }
}
