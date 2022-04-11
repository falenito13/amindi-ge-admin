<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CheckOut extends Model
{
    use HasFactory;

    protected $fillable = [
        'check_in_id',
        'finish_time'
    ];

    public function checkIns() : BelongsTo
    {
        return $this->belongsTo(CheckIn::class,'check_in_id','id');
    }
}
