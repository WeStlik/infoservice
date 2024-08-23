<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'type' => 'new',
                'status_text' => 'Новый',
                'badge_color' => 'bg-red-500',
            ],
            [
                'type' => 'in_progress',
                'status_text' => 'В работе',
                'badge_color' => 'bg-orange-500',
            ],
            [
                'type' => 'done',
                'status_text' => 'Завершен',
                'badge_color' => 'bg-green-500',
            ],
        ];

        DB::table('statuses')->insert($statuses);

    }
}
