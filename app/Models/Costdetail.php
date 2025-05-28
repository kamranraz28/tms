<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costdetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'cost_id',
        'service_id',
        'amount',
        'memo_upload',
    ];

    public function cost()
    {
        return $this->belongsTo(Cost::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
