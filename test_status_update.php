<?php
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Pengawasan;

echo "Status Update Test - Before and After File Upload\n";
echo "==============================================\n\n";

// Get current status
$pengawasans = Pengawasan::select('id', 'status_LHP', 'updated_at')->get();

echo "Current Status:\n";
foreach ($pengawasans as $pengawasan) {
    echo "ID: {$pengawasan->id} | Status: '{$pengawasan->status_LHP}' | Updated: {$pengawasan->updated_at}\n";
}

echo "\nInstructions:\n";
echo "1. Upload a file via the web interface\n";
echo "2. Run this script again to see the updated status\n";
echo "3. Check if the timestamp changed even if status was already 'Di Proses'\n\n";

echo "Expected behavior after upload:\n";
echo "- Status should be 'Di Proses'\n";
echo "- Updated_at timestamp should reflect the upload time\n";
echo "- Log should show 'Status successfully updated to Di Proses'\n";

echo "\nDone.\n";
