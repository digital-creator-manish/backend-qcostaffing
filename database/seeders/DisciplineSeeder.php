<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Discipline;

class DisciplineSeeder extends Seeder
{
    public $dataArr = [
        [
            'name' => "D1"
        ],
        [
            'name' => "D2"
        ],
        [
            'name' => "D3"
        ]
    ];

    public function run()
    {
        foreach ($this->dataArr as $data) {
            Discipline::create($data);
        }
    }
}
