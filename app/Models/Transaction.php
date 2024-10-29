<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location;
use App\Models\User;

class Transaction extends Model
{
    use HasFactory;

    /**
     * This function defines a belongs-to relationship, indicating that each transaction
     *  is associated with a single user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * This function defines a belongs-to relationship, indicating that each transaction
     *  is associated with a single location.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
