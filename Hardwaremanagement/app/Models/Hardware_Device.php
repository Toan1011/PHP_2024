<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hardware_Device extends Model
{
    use HasFactory;

    protected $table = 'hardwaredevices';

    protected $fillable = ['device_name', 'type', 'status', 'center_id'];

    // Quan hệ với ITCenter
    public function center()
    {
        return $this->belongsTo(IT_Center::class, 'center_id');
    }
}
