<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tutorial;

class TutorialSeeder extends Seeder
{
    public $dataArr = [
        'title' => "test-title"
    ];

    public function run()
    {
        Tutorial::create($this->dataArr);
    }
}
