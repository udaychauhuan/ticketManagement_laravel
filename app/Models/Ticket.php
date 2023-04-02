<?php

namespace App\Models;

use App\Notifications\TicketSoldNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = ['TicketName', 'TicketPrice', 'TicketDiscription', 'User_id'];

    //a ticket belongs to one user
    public function user(): BelongsTo
    {
        return  $this->belongsTo(User::class);
    }

    public function addtocart(): hasMany
    {
        return $this->hasMany(AddTocart::class);
    }

    public function purchased(): HasMany
    {
        return $this->hasMany(purchased::class);
    }

}
