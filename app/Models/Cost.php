<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'status',
    ];
    public function costDetails()
    {
        return $this->hasMany(Costdetail::class);
    }

}
