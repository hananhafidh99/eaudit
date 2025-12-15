@extends('template')
@section('content')
    <div class="card">
        <h5 class="card-header">Daftar Surat Tugas dan SPPD</h5>
        <div class="card-body">
            <form action="{{ url('arsip/cari') }}" method="post" class="mb-4">
                @csrf
                <div class="row align-items-end">
                    <div class="col-md-3">
                        <label class="form-label" for="nama_obrik">Obrik</label>
                        <input type="text" class="form-control" name="nama_obrik" id="nama_obrik"
                            placeholder="Cari Obrik...">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" for="nama_jenispengawasan">Jenis Pengawasan</label>
                        <input type="text" name="nama_jenispengawasan" id="nama_jenispengawasan" class="form-control"
                            placeholder="Cari Jenis Pengawasan...">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" for="bulan">Bulan</label>
                        <select name="tanggalAwalPenugasan" id="bulan" class="form-select select2">
                            <option value="">Pilih Bulan</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary w-100" type="submit">Cari Data</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-striped table-bordered" id="mytable">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>No Surat</th>
                            <th>Tanggal</th>
                            <th>Pegawai</th>
                            <th>Jenis Pengawasan</th>
                            <th>Obrik</th>
                            <th>Unduh Dokumen</th>
                            <th>Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @forelse ($data['data'] as $index => $v)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ '700.1.1/' . $v['noSurat'] . '/03' . '/' . date('Y') }}</td>
                                <td>
                                    {{ Carbon\Carbon::parse($v['tanggalAwalPenugasan'])->translatedFormat('d M Y') }} <br>
                                    <small class="text-muted">s/d</small> <br>
                                    {{ Carbon\Carbon::parse($v['tanggalAkhirPenugasan'])->translatedFormat('d M Y') }}
                                </td>
                                <td>
                                    @php
                                        $namapegawai_list = is_array($v['daftar_pegawai']) ? $v['daftar_pegawai'] : explode('@@', $v['daftar_pegawai']);
                                    @endphp
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($namapegawai_list as $item)
                                            <li>• {{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $v['nama_jenispengawasan'] }}</td>
                                <td>{{ $v['nama_obrik'] }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ url('surat_dalamKota/ST/' . $v['id']) }}"
                                            class="btn btn-sm btn-outline-danger" target="_blank" title="Surat Tugas">
                                            <i class="bx bxs-file-pdf"></i> ST
                                        </a>
                                        <a href="{{ url('surat_dalamKota/SD/' . $v['id']) }}"
                                            class="btn btn-sm btn-outline-danger" target="_blank" title="Surat Dinas">
                                            <i class="bx bxs-file-pdf"></i> SD
                                        </a>
                                        <a href="{{ url('surat_dalamKota/sppd/' . $v['id']) }}"
                                            class="btn btn-sm btn-outline-danger" target="_blank" title="SPPD">
                                            <i class="bx bxs-file-pdf"></i> SPPD
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ url('surat_dalamKota/buktipenerimaan/' . $v['id']) }}"
                                        class="btn btn-sm btn-outline-primary" target="_blank" title="Bukti Penerimaan">
                                        <i class="bx bx-receipt"></i> Bukti
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Only init select2 if it exists and logic requires it.
            // Assuming theme bootstrap-5 if available, else bootstrap4 or default
            if ($('.select2').length > 0) {
                $('.select2').select2({
                    theme: 'bootstrap-5', // Assuming Sneat uses BS5 theme for select2
                    width: '100%'
                });
            }
        });
    </script>
@endsection
