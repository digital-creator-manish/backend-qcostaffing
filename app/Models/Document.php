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
}
