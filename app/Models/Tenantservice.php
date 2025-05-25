<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenantservice extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'service_id',
        'value',
        'status',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
