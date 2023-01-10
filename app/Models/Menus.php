<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    use HasFactory;
    public $fillable = [
        'parent_id',
        'name',
        'priority',
        'status',
        'menu_type',
    ];
}
