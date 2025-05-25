<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position_id',
        'address',
        'status',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function tenant()
    {
        return $this->hasOne(Tenant::class);
    }

}
