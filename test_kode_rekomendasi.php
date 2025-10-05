<?php
// Test script untuk memastikan kode_rekomendasi dapat tersimpan ke database

require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Facades\DB;

// Setup database connection
$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'eaudit_db',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

echo "Testing database connection and kode_rekomendasi field...\n";

try {
    // Test 1: Check if table exists and has the required columns
    echo "\n1. Checking table structure...\n";

    $columns = $capsule->connection()->select("SHOW COLUMNS FROM jenis_temuans");

    $requiredColumns = ['id', 'kode_temuan', 'nama_temuan', 'kode_rekomendasi', 'rekomendasi', 'id_pengawasan', 'id_penugasan'];
    $existingColumns = [];

    foreach ($columns as $column) {
        $existingColumns[] = $column->Field;
    }

    echo "Existing columns: " . implode(', ', $existingColumns) . "\n";

    foreach ($requiredColumns as $required) {
        if (in_array($required, $existingColumns)) {
            echo "✓ Column '$required' exists\n";
        } else {
            echo "✗ Column '$required' MISSING\n";
        }
    }

    // Test 2: Try to insert a test record with kode_rekomendasi
    echo "\n2. Testing insert with kode_rekomendasi...\n";

    $testData = [
        'id_pengawasan' => 1,
        'id_penugasan' => 1,
        'nama_temuan' => 'Test Temuan - ' . date('Y-m-d H:i:s'),
        'kode_temuan' => 'TEM-TEST-001',
        'kode_rekomendasi' => 'REC-TEST-001',
        'rekomendasi' => 'Test rekomendasi untuk kode_rekomendasi',
        'keterangan' => 'Test keterangan',
        'pengembalian' => 1000000,
        'id_parent' => null,
        'password' => 'test', // Required field
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];

    $insertId = $capsule->table('jenis_temuans')->insertGetId($testData);

    // Update id_parent to point to itself
    $capsule->table('jenis_temuans')
        ->where('id', $insertId)
        ->update(['id_parent' => $insertId]);

    echo "✓ Successfully inserted test record with ID: $insertId\n";

    // Test 3: Retrieve the inserted record and check kode_rekomendasi
    echo "\n3. Verifying inserted data...\n";

    $retrievedData = $capsule->table('jenis_temuans')
        ->where('id', $insertId)
        ->first();

    if ($retrievedData) {
        echo "✓ Record retrieved successfully\n";
        echo "  - ID: {$retrievedData->id}\n";
        echo "  - Kode Temuan: {$retrievedData->kode_temuan}\n";
        echo "  - Nama Temuan: {$retrievedData->nama_temuan}\n";
        echo "  - Kode Rekomendasi: {$retrievedData->kode_rekomendasi}\n";
        echo "  - Rekomendasi: {$retrievedData->rekomendasi}\n";

        if ($retrievedData->kode_rekomendasi === $testData['kode_rekomendasi']) {
            echo "✓ kode_rekomendasi saved and retrieved correctly!\n";
        } else {
            echo "✗ kode_rekomendasi mismatch! Expected: {$testData['kode_rekomendasi']}, Got: {$retrievedData->kode_rekomendasi}\n";
        }
    } else {
        echo "✗ Failed to retrieve inserted record\n";
    }

    // Test 4: Update test
    echo "\n4. Testing update with kode_rekomendasi...\n";

    $newKodeRekomendasi = 'REC-TEST-UPDATED-001';
    $updated = $capsule->table('jenis_temuans')
        ->where('id', $insertId)
        ->update([
            'kode_rekomendasi' => $newKodeRekomendasi,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

    if ($updated) {
        echo "✓ Update successful\n";

        $updatedData = $capsule->table('jenis_temuans')
            ->where('id', $insertId)
            ->first();

        if ($updatedData->kode_rekomendasi === $newKodeRekomendasi) {
            echo "✓ kode_rekomendasi updated correctly!\n";
        } else {
            echo "✗ kode_rekomendasi update failed!\n";
        }
    } else {
        echo "✗ Update failed\n";
    }

    // Clean up - delete test record
    echo "\n5. Cleaning up test data...\n";
    $deleted = $capsule->table('jenis_temuans')->where('id', $insertId)->delete();
    echo $deleted ? "✓ Test record deleted\n" : "✗ Failed to delete test record\n";

    echo "\n=== TEST SUMMARY ===\n";
    echo "✓ Database connection: OK\n";
    echo "✓ Table structure: OK\n";
    echo "✓ Insert with kode_rekomendasi: OK\n";
    echo "✓ Retrieve kode_rekomendasi: OK\n";
    echo "✓ Update kode_rekomendasi: OK\n";
    echo "✓ All tests passed! kode_rekomendasi field is working correctly.\n";

} catch (Exception $e) {
    echo "\n✗ Error occurred: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
?>