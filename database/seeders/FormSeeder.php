<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Form;

class FormSeeder extends Seeder
{
    public $dataArr = [
        [
            'title' => "test-title",
            'form_type_id' => 1,
            'created_by' => 1,
            'updated_by' => 1
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->dataArr as $fillabe) {
            Form::create($fillabe);
        }        
    }
}
