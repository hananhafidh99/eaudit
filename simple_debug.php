<?php
// Simple debug script untuk cek kode_rekomendasi
echo "=== DEBUG KODE_REKOMENDASI SIMPLE ===\n\n";

try {
    // Database connection
    $host = 'localhost';
    $dbname = 'eaudit';  // Sesuaikan nama database
    $username = 'root';
    $password = '';

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "✅ Database connection successful\n\n";

    // Query data from jenis_temuans
    $sql = "SELECT id, kode_temuan, nama_temuan, kode_rekomendasi, rekomendasi, id_parent, id_pengawasan
            FROM jenis_temuans
            WHERE id_pengawasan IN (1, 2, 3, 4)
            ORDER BY id_pengawasan, id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_OBJ);

    if (empty($results)) {
        echo "❌ Tidak ada data dengan id_pengawasan yang tersedia\n";

        // Check available id_pengawasan
        $sql2 = "SELECT DISTINCT id_pengawasan FROM jenis_temuans ORDER BY id_pengawasan";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute();
        $available = $stmt2->fetchAll(PDO::FETCH_OBJ);

        echo "\nID pengawasan yang tersedia:\n";
        foreach ($available as $item) {
            echo "- {$item->id_pengawasan}\n";
        }
    } else {
        echo "✅ Ditemukan " . count($results) . " record total\n\n";

        foreach ($results as $row) {
            echo "=== RECORD ID: {$row->id} ===\n";
            echo "Kode Temuan: {$row->kode_temuan}\n";
            echo "Nama Temuan: {$row->nama_temuan}\n";
            echo "Kode Rekomendasi: " . ($row->kode_rekomendasi ?: 'NULL/EMPTY') . "\n";
            echo "Rekomendasi: {$row->rekomendasi}\n";
            echo "ID Parent: {$row->id_parent}\n";
            echo "ID Pengawasan: {$row->id_pengawasan}\n";
            echo "\n";
        }

        // Check if kode_rekomendasi has actual data
        $hasKodeRekom = false;
        foreach ($results as $row) {
            if (!empty($row->kode_rekomendasi)) {
                $hasKodeRekom = true;
                break;
            }
        }

        if ($hasKodeRekom) {
            echo "✅ KODE_REKOMENDASI field memiliki data!\n";
        } else {
            echo "❌ KODE_REKOMENDASI field kosong/NULL semua!\n";
        }
    }

} catch (PDOException $e) {
    echo "❌ Database Error: " . $e->getMessage() . "\n";
} catch (Exception $e) {
    echo "❌ General Error: " . $e->getMessage() . "\n";
}

echo "\n=== END DEBUG ===\n";
?>