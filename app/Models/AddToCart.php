<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AddToCart extends Model
{
    use HasFactory;

    protected $fillable = ['ticket_id','Quentity','user_id'];

    public $table = 'add_to_carts';

    // one tickets belongs to one user
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class );
    }

    //an add to cart have many ticket
    public function ticket():belongsTo
    {
     return $this->belongsTo(Ticket::class);
    }
}
