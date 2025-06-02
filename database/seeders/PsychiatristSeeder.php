<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Psych;

class PsychiatristSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $psychiatrists = [
        [
            'full_name' => 'Dr. Fariz Cipularang',
            'username' => 'fariz',
            'password' => bcrypt('password123'),
            'description' => 'Dr. Fariz is a licensed clinical psychologist with over 10 years of experience in treating anxiety, depression, and relationship issues.',
            'picture' => 'psychiatrists/fariz.jpg',
            'average_rating' => 0,
            'rating_count' => 0
        ],
        [
            'full_name' => 'Dr. Mayla Brebes',
            'username' => 'mayla',
            'password' => bcrypt('password123'),
            'description' => 'Dr. Mayla is a psychiatrist with expertise in mood disorders and anxiety. She combines medication management with therapeutic approaches.',
            'picture' => 'psychiatrists/mayla.jpg',
            'average_rating' => 0,
            'rating_count' => 0
        ],
        [
            'full_name' => 'Dr. Jamal Cil',
            'username' => 'jamal',
            'password' => bcrypt('password123'),
            'description' => 'Dr. Jamal specializes in family therapy and couples counseling, helping clients improve their relationships.',
            'picture' => 'psychiatrists/jamal.jpg',
            'average_rating' => 0,
            'rating_count' => 0
        ],
        [
            'full_name' => 'Dr. Sarah Pekalongan',
            'username' => 'sarah',
            'password' => bcrypt('password123'),
            'description' => 'Dr. Sarah is a child and adolescent psychologist who specializes in developmental disorders and academic challenges.',
            'picture' => 'psychiatrists/sarah.jpg',
            'average_rating' => 0,
            'rating_count' => 0
        ],
        [
            'full_name' => 'Dr. Ahmad Tegal',
            'username' => 'ahmad',
            'password' => bcrypt('password123'),
            'description' => 'Dr. Ahmad is an expert in career counseling and workplace stress management, helping clients navigate career transitions.',
            'picture' => 'psychiatrists/ahmad.jpg',
            'average_rating' => 0,
            'rating_count' => 0
        ],
        [
            'full_name' => 'Dr. Laila Soreang',
            'username' => 'laila',
            'password' => bcrypt('password123'),
            'description' => 'Dr. Laila has a background in trauma recovery and emotional resilience. She supports patients through personalized therapy sessions.',
            'picture' => 'psychiatrists/laila.jpg',
            'average_rating' => 0,
            'rating_count' => 0
        ],
    ];

        foreach ($psychiatrists as $psychiatrist) {
            Psych::create($psychiatrist);
        }
    }
}
