<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AppointmentCategory;

class AppointmentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Individual Counseling',
                'description' => 'One-on-one counseling sessions tailored to your specific needs. Our experienced counselors provide a safe space to discuss personal challenges and develop coping strategies.',
                'price' => 350000,
                'image' => 'categories/individual.jpg'
            ],
            [
                'name' => 'Couples Therapy',
                'description' => 'Strengthen your relationship with professional guidance. Our couples therapy helps improve communication, resolve conflicts, and build a healthier connection with your partner.',
                'price' => 450000,
                'image' => 'categories/couples.jpg'
            ],
            [
                'name' => 'Family Counseling',
                'description' => 'Address family dynamics and improve relationships between family members. Our family counseling sessions help resolve conflicts and create a more harmonious home environment.',
                'price' => 500000,
                'image' => 'categories/family.jpg'
            ],
            [
                'name' => 'Anxiety Management',
                'description' => 'Learn effective techniques to manage anxiety and reduce stress. Our specialists will help you understand your anxiety triggers and develop practical coping strategies.',
                'price' => 375000,
                'image' => 'categories/anxiety.jpg'
            ],
            [
                'name' => 'Depression Treatment',
                'description' => 'Comprehensive support for managing depression. Our approach combines therapeutic techniques and practical strategies to help you navigate through depression.',
                'price' => 375000,
                'image' => 'categories/depression.jpg'
            ],
            [
                'name' => 'Career Counseling',
                'description' => 'Get guidance on career decisions and workplace challenges. Our career counselors help you navigate professional growth, job transitions, and work-related stress.',
                'price' => 300000,
                'image' => 'categories/career.jpg'
            ],
        ];

        foreach ($categories as $category) {
            AppointmentCategory::create($category);
        }
    }
}
