<?php

namespace Database\Seeders;

use App\Models\OrderStatuses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'Sipariş Alındı',
            'Sipariş Hazırlanıyor',
            'Kargoya Verildi',
            'Yolda',
            'Teslim Edildi'
        ];

        foreach ($statuses as $status) {
            OrderStatuses::query()->create([
                'status' => $status
            ]);
        }
    }
}
