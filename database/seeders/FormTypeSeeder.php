<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FormType;

class FormTypeSeeder extends Seeder
{
    public $dataArr = [
        [
            'title' => "Onboarding Forms"
        ],
        [
            'title' => "Annual Forms"
        ],
        [
            'title' => "Both (Onboarding Forms + Annual Forms)"
        ]
    ];

    public function run()
    {
        //
        foreach ($this->dataArr as $fillabe) {
            FormType::create($fillabe);
        }
    }
}
