<?php

namespace Database\Seeders;

use App\Models\Highlight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HighlightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Highlight::factory()->count(100)->create();
    }
}
