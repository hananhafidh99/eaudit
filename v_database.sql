create view v_demo3 AS SELECT
    `p`.`id` AS `id`,
    `p`.`noSurat` AS `noSurat`,
    `p`.`tanggalAwalPenugasan` AS `tanggalAwalPenugasan`,
    `p`.`tanggalAkhirPenugasan` AS `tanggalAkhirPenugasan`,
    `p`.`tanggalTerbitPenugasan` AS `tanggalTerbitPenugasan`,
    `jp`.`nama_jenispengawasan` AS `nama_jenispengawasan`,
    `o`.`nama_obrik` AS `nama_obrik`,
    `k`.`kegiatan` AS `kegiatan`,
    MIN(`st`.`tanggalAwalPemeriksaan`) AS `tanggalAwalPemeriksaan`,
    MAX(`st`.`tanggalAkhirPemeriksaan`) AS `tanggalAkhirPemeriksaan`,
    GROUP_CONCAT(
        `pg`.`nama_pegawai`
    ORDER BY
        `pr`.`id` ASC,
        `st`.`id` ASC SEPARATOR '@@ '
    ) AS `daftar_pegawai`,
    CONCAT(
        '[',
        GROUP_CONCAT(
            JSON_OBJECT(
                'namapegawai',
                `pg`.`nama_pegawai`,
                'nip',
                `pg`.`nip`,
                'peran',
                `pr`.`nama_peran`
            )
        ORDER BY
            `pr`.`id` ASC SEPARATOR ','
        ),
        ']'
    ) AS `detail_petugas`
FROM
    (
        (
            (
                (
                    (
                        (
                            `eaudit`.`penugasans` `p`
                        JOIN `eaudit`.`jenis__pengawasans` `jp`
                        ON
                            ((`jp`.`id` = `p`.`id_jenisPengawasan`))
                        )
                    JOIN `eaudit`.`obriks` `o`
                    ON
                        ((`o`.`id` = `p`.`id_obrik`))
                    )
                JOIN `eaudit`.`kegiatans` `k`
                ON
                    ((`k`.`id` = `p`.`id_anggaran`))
                )
            JOIN `eaudit`.`surat_tugas` `st`
            ON
                ((`st`.`id_penugasan` = `p`.`id`))
            )
        JOIN `eaudit`.`pegawais` `pg`
        ON
            ((`pg`.`id` = `st`.`id_pegawai`))
        )
    JOIN `eaudit`.`perans` `pr`
    ON
        ((`pr`.`id` = `st`.`id_peran`))
    )
GROUP BY
    `p`.`id`,
    `p`.`noSurat`,
    `p`.`tanggalAwalPenugasan`,
    `p`.`tanggalAkhirPenugasan`,
    `p`.`tanggalTerbitPenugasan`,
    `jp`.`nama_jenispengawasan`,
    `o`.`nama_obrik`,
    `k`.`kegiatan`;

create view v_tl1 AS SELECT
    `pt`.`id` AS `id`,
    `pt`.`tglkeluar` AS `tglkeluar`,
    `pt`.`status_LHP` AS `status_LHP`,
    `pt`.`tipe` AS `tipe`,
    `pt`.`jenis` AS `jenis`,
    `pt`.`wilayah` AS `wilayah`,
    `pt`.`pemeriksa` AS `pemeriksa`,
    `p`.`noSurat` AS `noSurat`,
    `p`.`id` AS `id_penugasan`,
    `p`.`tanggalAwalPenugasan` AS `tanggalAwalPenugasan`,
    `p`.`tanggalAkhirPenugasan` AS `tanggalAkhirPenugasan`,
    `jp`.`nama_jenispengawasan` AS `nama_jenispengawasan`,
    `o`.`nama_obrik` AS `nama_obrik`
FROM
    (
        (
            (
                `eaudit`.`pengawasans` `pt`
            JOIN `eaudit`.`penugasans` `p`
            ON
                ((`p`.`id` = `pt`.`id_penugasan`))
            )
        JOIN `eaudit`.`obriks` `o`
        ON
            ((`o`.`id` = `p`.`id_obrik`))
        )
    JOIN `eaudit`.`jenis__pengawasans` `jp`
    ON
        ((`jp`.`id` = `p`.`id_jenisPengawasan`))
    )
GROUP BY
    `pt`.`id`,
    `jp`.`nama_jenispengawasan`,
    `o`.`nama_obrik`;

    create view v_tl2 AS SELECT
    `pt`.`id` AS `id`,
    `pt`.`tglkeluar` AS `tglkeluar`,
    `pt`.`status_LHP` AS `status_LHP`,
    `pt`.`tipe` AS `tipe`,
    `pt`.`jenis` AS `jenis`,
    `pt`.`wilayah` AS `wilayah`,
    `pt`.`pemeriksa` AS `pemeriksa`,
    `p`.`noSurat` AS `noSurat`,
    `p`.`id` AS `id_penugasan`,
    `p`.`tanggalAwalPenugasan` AS `tanggalAwalPenugasan`,
    `p`.`tanggalAkhirPenugasan` AS `tanggalAkhirPenugasan`,
    `jp`.`nama_jenispengawasan` AS `nama_jenispengawasan`,
    `o`.`nama_obrik` AS `nama_obrik`,
    GROUP_CONCAT(
        `jt`.`rekomendasi`
    ORDER BY
        `jt`.`id` ASC SEPARATOR '@@ '
    ) AS `daftar_rekom`,
    CONCAT(
        '[',
        GROUP_CONCAT(
            JSON_OBJECT(
                'kode_rekomendasi',
                `jt`.`kode_rekomendasi`,
                'rekomendasi',
                `jt`.`rekomendasi`,
                'keterangan',
                `jt`.`keterangan`,
                'pengembalian',
                `jt`.`pengembalian`
            )
        ORDER BY
            `jt`.`id_parent` ASC SEPARATOR ','
        ),
        ']'
    ) AS `detail_rekom`
FROM
    (
        (
            (
                (
                    `eaudit`.`jenis_temuans` `jt`
                JOIN `eaudit`.`penugasans` `p`
                ON
                    ((`jt`.`id_penugasan` = `p`.`id`))
                )
            JOIN `eaudit`.`obriks` `o`
            ON
                ((`o`.`id` = `p`.`id_obrik`))
            )
        JOIN `eaudit`.`jenis__pengawasans` `jp`
        ON
            ((`jp`.`id` = `p`.`id_jenisPengawasan`))
        )
    JOIN `eaudit`.`pengawasans` `pt`
    ON
        ((`jt`.`id_pengawasan` = `pt`.`id`))
    );
