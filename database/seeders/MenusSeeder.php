<?php

namespace Database\Seeders;

use App\Models\Menus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenusSeeder extends Seeder
{
    public $dataArr = [
        [
            'parent_id' => 0,
            'name' => "Nurses",
            'priority' => 1,
            'status' => 1,
            'menu_type' => 1,
        ],
        [
            'parent_id' => 0,
            'name' => "Nurses Archive",
            'priority' => 2,
            'status' => 1,
            'menu_type' => 1,
        ],
        [
            'parent_id' => 0,
            'name' => "Management Staff",
            'priority' => 3,
            'status' => 1,
            'menu_type' => 1,
        ],
        [
            'parent_id' => 0,
            'name' => "Facility",
            'priority' => 4,
            'status' => 1,
            'menu_type' => 1,
        ],
        [
            'parent_id' => 0,
            'name' => "News",
            'priority' => 5,
            'status' => 1,
            'menu_type' => 1,
        ],
        [
            'parent_id' => 0,
            'name' => "Tutorial",
            'priority' => 6,
            'status' => 1,
            'menu_type' => 1,
        ],
        [
            'parent_id' => 0,
            'name' => "Forms",
            'priority' => 7,
            'status' => 1,
            'menu_type' => 1,
        ],
        [
            'parent_id' => 0,
            'name' => "Skills",
            'priority' => 8,
            'status' => 1,
            'menu_type' => 1,
        ],
        [
            'parent_id' => 0,
            'name' => "Document",
            'priority' => 9,
            'status' => 1,
            'menu_type' => 1,
        ],
        [
            'parent_id' => 0,
            'name' => "Site Content",
            'priority' => 10,
            'status' => 1,
            'menu_type' => 1,
        ],
        [
            'parent_id' => 0,
            'name' => "Discipline",
            'priority' => 11,
            'status' => 1,
            'menu_type' => 1,
        ],
        [
            'parent_id' => 0,
            'name' => "Client User",
            'priority' => 12,
            'status' => 1,
            'menu_type' => 2,
        ],
        [
            'parent_id' => 0,
            'name' => "Client Facility",
            'priority' => 13,
            'status' => 1,
            'menu_type' => 2,
        ],
        [
            'parent_id' => 0,
            'name' => "Manage Skills",
            'priority' => 14,
            'status' => 1,
            'menu_type' => 2,
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
            Menus::create($fillabe);
        }        
    }
}
