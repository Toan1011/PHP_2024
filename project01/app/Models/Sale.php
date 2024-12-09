<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_id',
        'quantity',
        'sale_date',
        'customer_phone',
    ];

    // Định nghĩa mối quan hệ với model Medicine
    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }
}

