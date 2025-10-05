<?php
require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;

// Set up Laravel configuration
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Initialize database configuration
$app['config']->set('database.connections.mysql', [
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'port' => '3306',
    'database' => 'v_database',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
]);

$app['config']->set('database.default', 'mysql');

// Test query exact sama seperti di controller
$id_pengawasan = 1;

echo "Testing query similar to controller...\n";

try {
    $allData = DB::table('jenis_temuans')
        ->select('*')
        ->where('id_pengawasan', $id_pengawasan)
        ->orderBy('kode_temuan')
        ->orderBy('id')
        ->get();

    echo "Total data found: " . $allData->count() . "\n";

    if ($allData->count() > 0) {
        echo "\nSample data with kode_rekomendasi:\n";
        foreach ($allData->take(3) as $item) {
            echo "ID: {$item->id}\n";
            echo "Kode Temuan: {$item->kode_temuan}\n";
            echo "Nama Temuan: {$item->nama_temuan}\n";
            echo "Kode Rekomendasi: '" . ($item->kode_rekomendasi ?? 'NULL') . "'\n";
            echo "Rekomendasi: {$item->rekomendasi}\n";
            echo "ID Parent: {$item->id_parent}\n";
            echo "---\n";
        }

        // Group data seperti di controller
        $groupedData = [];

        foreach ($allData as $item) {
            $key = $item->kode_temuan . '|' . $item->nama_temuan;

            if (!isset($groupedData[$key])) {
                $groupedData[$key] = [
                    'kode_temuan' => $item->kode_temuan,
                    'nama_temuan' => $item->nama_temuan,
                    'recommendations' => []
                ];
            }

            $groupedData[$key]['recommendations'][] = $item;
        }

        echo "\nGrouped data structure:\n";
        foreach ($groupedData as $key => $group) {
            echo "Group Key: {$key}\n";
            echo "Recommendations count: " . count($group['recommendations']) . "\n";

            foreach ($group['recommendations'] as $rekom) {
                echo "  - ID: {$rekom->id}, Kode Rekom: '" . ($rekom->kode_rekomendasi ?? 'NULL') . "'\n";
            }
            echo "---\n";
        }
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
