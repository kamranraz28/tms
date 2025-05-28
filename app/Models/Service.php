<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    public function tenantServices()
    {
        return $this->hasMany(Tenantservice::class);
    }
    public function costDetails()
    {
        return $this->hasMany(Costdetail::class);
    }
}
