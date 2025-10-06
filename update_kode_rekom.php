<?php
// Update kode_rekomendasi for id_pengawasan = 1
try {
    $pdo = new PDO('mysql:host=localhost;dbname=eaudit', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Update records for id_pengawasan = 1 dengan kode_rekomendasi
    $updates = [
        ['id' => 295, 'kode_rekomendasi' => 'REC-B1-001'],
        ['id' => 296, 'kode_rekomendasi' => 'REC-B1-002'],
        ['id' => 297, 'kode_rekomendasi' => 'REC-B1-003']
    ];

    foreach ($updates as $update) {
        $sql = 'UPDATE jenis_temuans SET kode_rekomendasi = :kode WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'kode' => $update['kode_rekomendasi'],
            'id' => $update['id']
        ]);
        echo "Updated ID {$update['id']} with kode_rekomendasi: {$update['kode_rekomendasi']}\n";
    }

    echo "All updates completed successfully!\n";

    // Verify the updates
    echo "\nVerification:\n";
    $sql = "SELECT id, kode_temuan, nama_temuan, kode_rekomendasi, rekomendasi FROM jenis_temuans WHERE id_pengawasan = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_OBJ);

    foreach ($results as $row) {
        echo "ID: {$row->id} - kode_rekomendasi: {$row->kode_rekomendasi}\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>