<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class Location extends Model
{
    use HasFactory;

     /**
     * This function defines a one-to-many relationship, where a single location
     * can have many transactions.
     */

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
