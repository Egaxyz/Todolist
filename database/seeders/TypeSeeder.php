<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::create([
            'name' => 'Job',
            'description' => 'A job type',
        ]);
        Type::create([
            'name' => 'Task',
            'description' => 'A task type',
        ]);
        Type::create([
            'name' => 'Event',
            'description' => 'An event type',
        ]);
        Type::create([
            'name' => 'Note',
            'description' => 'A note type',
        ]);
    }
}