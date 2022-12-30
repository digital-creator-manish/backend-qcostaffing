<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseDuty extends Model
{
    use HasFactory;
    protected $fillable = ['nurse_id', 'available_duty', 'available_dutytime', 'available_day'];

    public function Nurses()
    {
        return $this->belongsTo(Nurses::class, 'nurse_id');
        //Or: return $this->belongsTo(Profile::class, 'foreign_key');
    }
}
