<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AppointmentSlot;
use App\Models\Psych;
use Carbon\Carbon;

class AppointmentSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $psychiatrists = Psych::all();
        
        // Generate slots for the next 14 days
        $startDate = Carbon::now()->startOfDay();
        $endDate = Carbon::now()->addDays(14)->endOfDay();
        
        $timeSlots = [
            ['09:00:00', '10:00:00'],
            ['10:30:00', '11:30:00'],
            ['13:00:00', '14:00:00'],
            ['14:30:00', '15:30:00'],
            ['16:00:00', '17:00:00']
        ];
        
        foreach ($psychiatrists as $psychiatrist) {
            $currentDate = clone $startDate;
            
            while ($currentDate <= $endDate) {
                // Skip weekends
                if ($currentDate->isWeekend()) {
                    $currentDate->addDay();
                    continue;
                }
                
                foreach ($timeSlots as $timeSlot) {
                    // Randomly skip some slots to make it more realistic
                    if (rand(0, 10) < 3) {
                        continue;
                    }
                    
                    AppointmentSlot::create([
                        'psychiatrist_id' => $psychiatrist->id,
                        'date' => $currentDate->format('Y-m-d'),
                        'start_time' => $timeSlot[0],
                        'end_time' => $timeSlot[1],
                        'is_booked' => false
                    ]);
                }
                
                $currentDate->addDay();
            }
        }
    }
}
