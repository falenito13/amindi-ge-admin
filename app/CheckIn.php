<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CheckIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'work_time',
    ];

    public function checkOut() : HasOne
    {
        return $this->hasOne(CheckOut::class);
    }
}
