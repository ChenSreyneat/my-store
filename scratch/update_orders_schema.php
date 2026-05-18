<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

use Illuminate\Support\Facades\DB;

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'paid', 'processing', 'shipped', 'completed', 'cancelled', 'refunded') DEFAULT 'pending'");
    echo "Successfully updated orders table schema.\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
