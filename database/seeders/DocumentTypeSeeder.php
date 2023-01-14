<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DocumentType;

class DocumentTypeSeeder extends Seeder
{
    public $dataArr = [
        [
            'title' => "RN"
        ],
        [
            'title' => "LPN"
        ],
        [
            'title' => "CNA"
        ],
        [
            'title' => "Direct Care"
        ],
        [
            'title' => "Mental Health Tech"
        ],
        [
            'title' => "Nurse Practitioner"
        ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->dataArr as $fillabe) {
            DocumentType::create($fillabe);
        }        
    }
}
