<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizTutorial extends Model
{
    use HasFactory;
    protected $fillable = ['tutorial_id', 'q', 'q1', 'q2', 'q3', 'q4', 'ans', 'created_by', 'updated_by'];

    public function tutorial_id()
    {
        return $this->hasOne(Tutorial::class, 'id', 'tutorial_id');
    }

    public function created_by()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function updated_by()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }
}
