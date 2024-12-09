<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'dosage',
        'form',
        'price',
        'stock',
    ];

    // Định nghĩa mối quan hệ với model Sale
    public function sales()
    {
        return $this->hasMany(Sale::class, 'medicine_id');
    }
}
