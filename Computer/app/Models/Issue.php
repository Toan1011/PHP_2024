<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = ['reported_by', 'reported_date', 'description', 'urgency', 'status', 'computer_id'];

    public function computer(){
        return $this->belongsTo(Computer::class);
    }
}
