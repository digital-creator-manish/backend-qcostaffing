<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'form_type_id', 'filename', 'created_by', 'updated_by'];

    public function form_type_id()
    {
        return $this->hasOne(FormType::class, 'id', 'form_type_id');
    }


    public function created_by()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function updated_by()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }

    public function discipline()
    {
        //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
        return $this->belongsToMany(Discipline::class, 'disciplines_forms', 'form_id', 'discipline_id');
    }
}
