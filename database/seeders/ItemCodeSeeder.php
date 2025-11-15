<?php

namespace Database\Seeders;

use App\Models\ItemCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ItemCode::factory()->count(10)->create();
    }
}
