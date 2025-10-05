<?php
// Simple PDO debug untuk test data kode_rekomendasi

$host = '127.0.0.1';
$dbname = 'eaudit';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected to database successfully\n\n";

    // Test query sama seperti di controller
    $id_pengawasan = 1;

    $sql = "SELECT * FROM jenis_temuans WHERE id_pengawasan = ? ORDER BY kode_temuan, id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_pengawasan]);
    $allData = $stmt->fetchAll(PDO::FETCH_OBJ);

    echo "Total data found: " . count($allData) . "\n\n";

    if (count($allData) > 0) {
        echo "Sample data dengan kode_rekomendasi:\n";
        echo str_repeat("=", 50) . "\n";

        foreach (array_slice($allData, 0, 5) as $item) {
            echo "ID: {$item->id}\n";
            echo "Kode Temuan: {$item->kode_temuan}\n";
            echo "Nama Temuan: {$item->nama_temuan}\n";
            echo "Kode Rekomendasi: '" . ($item->kode_rekomendasi ?? 'NULL') . "'\n";
            echo "Rekomendasi: " . substr($item->rekomendasi, 0, 50) . "...\n";
            echo "ID Parent: {$item->id_parent}\n";
            echo "Created at: {$item->created_at}\n";
            echo str_repeat("-", 30) . "\n";
        }

        // Cek apakah ada data dengan kode_rekomendasi yang tidak NULL atau kosong
        $withKodeRekom = array_filter($allData, function ($item) {
            return !empty($item->kode_rekomendasi) && $item->kode_rekomendasi !== null;
        });

        echo "\nData dengan kode_rekomendasi tidak kosong: " . count($withKodeRekom) . "\n";

        if (count($withKodeRekom) > 0) {
            echo "Contoh data dengan kode_rekomendasi:\n";
            foreach (array_slice($withKodeRekom, 0, 3) as $item) {
                echo "- ID: {$item->id}, Kode Rekom: '{$item->kode_rekomendasi}', Rekomendasi: " . substr($item->rekomendasi, 0, 30) . "...\n";
            }
        }

        // Group data seperti di controller untuk test hierarchy
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

        echo "\n" . str_repeat("=", 50) . "\n";
        echo "GROUPED DATA STRUCTURE:\n";
        echo str_repeat("=", 50) . "\n";

        foreach ($groupedData as $key => $group) {
            echo "Group: {$key}\n";
            echo "Total recommendations: " . count($group['recommendations']) . "\n";

            foreach ($group['recommendations'] as $rekom) {
                $kodeRekom = $rekom->kode_rekomendasi ?? 'NULL';
                if (empty($kodeRekom)) {
                    $kodeRekom = 'EMPTY';
                }
                echo "  └─ ID: {$rekom->id} | Kode Rekom: '{$kodeRekom}' | Parent: {$rekom->id_parent}\n";
            }
            echo "\n";
        }
    } else {
        echo "No data found for id_pengawasan = {$id_pengawasan}\n";
    }

} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage() . "\n";
}
