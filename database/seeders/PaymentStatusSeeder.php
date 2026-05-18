<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentStatus;

class PaymentStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ['Pending', 'Success', 'Failed', 'Cancelled'];
        foreach ($statuses as $status) {
            PaymentStatus::updateOrCreate(['name' => $status]);
        }
    }
}
