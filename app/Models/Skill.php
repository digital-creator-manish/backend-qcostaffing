<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'document'];

    public function discipline()
    {
        return $this->hasOne(Discipline::class, 'discipline_id');
    }
}
