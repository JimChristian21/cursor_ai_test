<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Todo::create([
            'title' => 'Welcome to your Todo App!',
            'description' => 'This is a sample todo to get you started. You can edit, complete, or delete this.',
            'completed' => false
        ]);

        Todo::create([
            'title' => 'Learn Laravel with Inertia.js',
            'description' => 'Explore the power of Laravel backend with Vue.js frontend using Inertia.js',
            'completed' => false
        ]);

        Todo::create([
            'title' => 'Build something amazing',
            'description' => 'Use this todo app as a foundation to build your next great project!',
            'completed' => false
        ]);

        Todo::create([
            'title' => 'Completed Task Example',
            'description' => 'This shows how completed tasks look in the interface',
            'completed' => true
        ]);
    }
}
