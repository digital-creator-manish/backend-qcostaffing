<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;
    protected $fillable = ["name"];


    public function skill(){
        return $this->belongsTo(Skill::class, 'discipline_id', 'id');
    }
}
