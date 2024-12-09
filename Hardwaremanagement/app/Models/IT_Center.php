<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IT_Center extends Model
{
    use HasFactory;

    protected $table = 'itcenters';

    protected $fillable = ['name', 'location', 'contact_email'];

    // Quan hệ với HardwareDevice
    public function devices()
    {
        return $this->hasMany(HardwareDevice::class, 'center_id');
    }
}
