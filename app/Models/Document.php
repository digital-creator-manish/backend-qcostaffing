<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = ["filename", "document_type_id", "created_by"];

    public function document_type_id()
    {
        return $this->hasOne(DocumentType::class, 'id', 'document_type_id');
    }

    public function created_by()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function discipline()
    {
        //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
        return $this->belongsToMany(Document::class, 'disciplines_documents', 'document_id', 'discipline_id');
    }
}
