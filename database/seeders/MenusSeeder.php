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
            'name_key' => "nurses",
            'priority' => 1,
            'status' => 1,
            'menu_type' => 1,
        ],
        [
            'parent_id' => 0,
            'name' => "Nurses Archive",
            'name_key' => "nurses_archive",
            'priority' => 2,
            'status' => 1,
            'menu_type' => 1,
        ],
        [
            'parent_id' => 0,
            'name' => "Management Staff",
            'name_key' => "staff",
            'priority' => 3,
            'status' => 1,
            'menu_type' => 1,
        ],
        [
            'parent_id' => 0,
            'name' => "Facility",
            'name_key' => "facility",
            'priority' => 4,
            'status' => 1,
            'menu_type' => 1,
        ],
        [
            'parent_id' => 0,
            'name' => "News",
            'name_key' => "news",
            'priority' => 5,
            'status' => 1,
            'menu_type' => 1,
        ],
        [
            'parent_id' => 0,
            'name' => "Tutorial",
            'name_key' => "tutorial",
            'priority' => 6,
            'status' => 1,
            'menu_type' => 1,
        ],
        [
            'parent_id' => 0,
            'name' => "Forms",
            'name_key' => "forms",
            'priority' => 7,
            'status' => 1,
            'menu_type' => 1,
        ],
        [
            'parent_id' => 0,
            'name' => "Skills",
            'name_key' => "skills",
            'priority' => 8,
            'status' => 1,
            'menu_type' => 1,
        ],
        [
            'parent_id' => 0,
            'name' => "Document",
            'name_key' => "document",
            'priority' => 9,
            'status' => 1,
            'menu_type' => 1,
        ],
        [
            'parent_id' => 0,
            'name' => "Site Content",
            'name_key' => "site_content",
            'priority' => 10,
            'status' => 1,
            'menu_type' => 1,
        ],
        [
            'parent_id' => 0,
            'name' => "Discipline",
            'name_key' => "discipline",
            'priority' => 11,
            'status' => 1,
            'menu_type' => 1,
        ],
        [
            'parent_id' => 0,
            'name' => "Client User",
            'name_key' => "client_user",
            'priority' => 12,
            'status' => 1,
            'menu_type' => 2,
        ],
        [
            'parent_id' => 0,
            'name' => "Client Facility",
            'name_key' => "client_facility",
            'priority' => 13,
            'status' => 1,
            'menu_type' => 2,
        ],
        [
            'parent_id' => 0,
            'name' => "Manage Skills",
            'name_key' => "manage_skills",
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
