<?php

namespace App\Console\Commands;

use App\Models\OrderStatuses;
use Illuminate\Console\Command;

class AddIconToOrderStatuses extends Command
{
    protected $signature = 'os:icon';

    protected $description = 'Add icon name to order_statuses table';

    public function handle()
    {
        $statusIcon = [
            'fa-solid fa-thumbs-up',
            'fa-solid fa-list-check',
            'fa-solid fa-truck-ramp-box',
            'fa-solid fa-road',
            'fa-solid fa-check',
        ];

        $i = 1;
        foreach ($statusIcon as $icon) {
            OrderStatuses::query()
                ->where('id', $i)
                ->update(['icon' => $icon]);
            $i++;
        }
        return Command::SUCCESS;
    }
}
