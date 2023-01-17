<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = ["title", "description", "file", "show", "created_by", "updated_by"];

    public function created_by()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function updated_by()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }


}
