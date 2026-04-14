<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;


class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
            [
                'plane_name'  => 'Garuda Indonesia - GA123',
                'origin'      => 'Jakarta (CGK)',
                'destination' => 'Bali (DPS)',
                'departure'   => '2026-05-10 08:00:00',
                'price'       => 1500000,
                'stock'       => 50,
            ],
            [
                'plane_name'  => 'AirAsia - QZ551',
                'origin'      => 'Surabaya (SUB)',
                'destination' => 'Singapore (SIN)',
                'departure'   => '2026-05-11 13:30:00',
                'price'       => 850000,
                'stock'       => 30,
            ],
            [
                'plane_name'  => 'Lion Air - JT770',
                'origin'      => 'Medan (KNO)',
                'departure'   => '2026-05-12 10:15:00',
                'destination' => 'Jakarta (CGK)',
                'price'       => 1200000,
                'stock'       => 100,
            ],
        ];
        foreach ($schedules as $schedule) {
            Schedule::updateOrCreate(
                [
                    'plane_name' => $schedule['plane_name'],
                    'origin' => $schedule['origin'],
                    'destination' => $schedule['destination'],
                    'departure' => $schedule['departure'],
                ],
                $schedule
            );
        }
    }
}
