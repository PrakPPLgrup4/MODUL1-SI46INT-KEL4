<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Voucher;
use Carbon\Carbon;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vouchers = [
            [
                'name' => 'Free Journal Session',
                'description' => 'Redeem this voucher to get a free journal session with our specialists. A great way to start your mental health journey.',
                'points_required' => 50,
                'code' => 'JOURNAL50',
                'valid_until' => Carbon::now()->addMonths(3),
                'is_active' => true
            ],
            [
                'name' => '15% Off Any Appointment',
                'description' => 'Get 15% off on your next appointment booking with any of our specialists. Valid for all counseling categories.',
                'points_required' => 100,
                'code' => 'APPT15OFF',
                'valid_until' => Carbon::now()->addMonths(2),
                'is_active' => true
            ],
            [
                'name' => 'Free E-Book: Mental Wellness',
                'description' => 'Redeem this voucher to receive our exclusive e-book on mental wellness techniques and daily practices for better mental health.',
                'points_required' => 30,
                'code' => 'EBOOK30',
                'valid_until' => Carbon::now()->addMonths(6),
                'is_active' => true
            ],
            [
                'name' => 'Premium Membership (1 Month)',
                'description' => 'Get access to our premium membership features including unlimited journal entries, priority booking, and exclusive webinars for one month.',
                'points_required' => 200,
                'code' => 'PREMIUM1M',
                'valid_until' => Carbon::now()->addMonths(3),
                'is_active' => true
            ],
            [
                'name' => 'Free Group Therapy Session',
                'description' => 'Join one of our therapeutic group sessions for free. Connect with others facing similar challenges in a supportive environment.',
                'points_required' => 75,
                'code' => 'GROUP75',
                'valid_until' => Carbon::now()->addMonths(2),
                'is_active' => true
            ],
        ];

        foreach ($vouchers as $voucher) {
            Voucher::create($voucher);
        }
    }
}
