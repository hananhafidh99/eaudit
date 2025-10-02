@extends('template')
@section('content')
<style>
    #mytable {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    #mytable td, #mytable th {
      border: 2px solid #000;
      padding: 8px;
    }

    #mytable th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #04AA6D;
      color: white;
    }

    #mytable1 {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    #mytable1 td, #mytable th {
      border: 2px solid #000;
      padding: 8px;
    }

    #mytable1 th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color:#32CD32;
      color: white;
    }

     /* Rekomendasi Table Styles */
    #rekomendasi-table {
        border: 3px solid #000;
        font-size: 0.9rem;
        border-collapse: separate;
        border-spacing: 0;
    }

    #rekomendasi-table th {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        text-align: center;
        vertical-align: middle;
        font-weight: bold;
        border: 2px solid #000;
        padding: 15px 10px;
        font-size: 0.95rem;
    }

    #rekomendasi-table td {
        border: 2px solid #000;
        padding: 10px 8px;
        vertical-align: middle;
    }

    /* Temuan Header Row Styles */
    .temuan-header {
        background-color: #fff3cd !important;
        border-left: 5px solid #ffc107 !important;
        border-top: 3px solid #000 !important;
    }

    .temuan-header td:first-child {
        font-weight: bold;
        font-size: 1.3em;
        background-color: #ffeaa7 !important;
        text-align: center;
        color: #721c24;
        border-right: 3px solid #000;
    }

    .temuan-header td:nth-child(2) {
        font-weight: bold;
        background-color: #fff3cd !important;
        color: #721c24;
        font-size: 1.05em;
        border-right: 3px solid #000;
    }

    /* Temuan Sub Row Styles */
    .temuan-sub-row {
        background-color: #f8f9fa !important;
        border-left: 5px solid #6c757d !important;
    }

    .temuan-sub-row td {
        background-color: #f8f9fa !important;
        padding: 15px 12px;
    }

    /* Action Row Styles */
    .action-row {
        background-color: #e7f3ff !important;
        border-left: 5px solid #007bff !important;
        border-top: 2px solid #007bff !important;
    }

    .action-row td {
        background-color: #e7f3ff !important;
        padding: 15px;
    }

    /* Badge Styles */
    .badge {
        font-size: 0.85em;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .badge.bg-primary {
        background: linear-gradient(135deg, #007bff, #0056b3) !important;
    }

    .badge.bg-info {
        background: linear-gradient(135deg, #17a2b8, #138496) !important;
    }

    .badge.bg-secondary {
        background: linear-gradient(135deg, #6c757d, #545b62) !important;
    }

    /* Form Controls */
    .form-control {
        font-size: 0.9rem;
        border: 2px solid #ced4da;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.3rem rgba(0, 123, 255, 0.15);
        background-color: #f8f9ff;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 80px;
    }

    /* Form Labels */
    .form-label {
        font-size: 0.85rem;
        margin-bottom: 8px;
        font-weight: 600;
    }

    /* Table Cell Padding */
    #rekomendasi-table td {
        padding: 15px 12px;
        vertical-align: top;
    }

    /* Input styling for pengembalian */
    input[type="text"].tanparupiah {
        font-weight: 600;
        text-align: right;
        background-color: #fff8e1;
    }

    input[type="text"].tanparupiah:focus {
        background-color: #fff3cd;
    }

    /* Button Styles */
    .btn-sm {
        padding: 0.3rem 0.6rem;
        font-size: 0.8rem;
        border-radius: 4px;
        font-weight: 500;
    }

    .text-center .btn {
        margin: 2px;
    }

    .btn-success {
        background: linear-gradient(135deg, #28a745, #1e7e34);
        border: none;
    }

    .btn-danger {
        background: linear-gradient(135deg, #dc3545, #bd2130);
        border: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
        border: none;
    }

    /* Hover Effects */
    .parent-row:hover {
        background-color: #fff8d1 !important;
    }

    .sub-row:hover {
        background-color: #c3e3ec !important;
    }

    .subsub-row:hover {
        background-color: #f1f3f4 !important;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        #rekomendasi-table {
            font-size: 0.8rem;
        }

        .form-control {
            font-size: 0.8rem;
        }

        .btn-sm {
            padding: 0.25rem 0.4rem;
            font-size: 0.75rem;
        }
    }

    /* Upload Progress Styles */
    #progressBarsContainer {
        max-height: 400px;
        overflow-y: auto;
    }

    .progress {
        background-color: #e9ecef;
        border-radius: 0.375rem;
    }

    .progress-bar {
        display: flex;
        flex-direction: column;
        justify-content: center;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        background-color: #0d6efd;
        transition: width 0.6s ease;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .upload-item {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 1rem;
        margin-bottom: 0.75rem;
        background-color: #fff;
    }

    .upload-item:hover {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .file-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .file-name {
        font-weight: 600;
        color: #495057;
        word-break: break-word;
    }

    .file-size {
        font-size: 0.875rem;
        color: #6c757d;
        margin-left: 0.5rem;
    }

    .upload-status {
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    .btn-delete-file {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Button trigger modal -->

<div class="card mb-4" style="width: 100%;">
    <div class="card-header">Data Penugasan</div>
    <div class="card-body">
        <form action="{{ url('/jabatan_baru'.$pengawasan['id']) }}" method="post" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div class="row">
                <div class="col-3 mt-2">
                    <label for="">Nomor Surat </label>
                </div>
                <div class="col-3 mb-3">
                    <textarea name="nama" style="color: black; background-color:white" class="form-control" readonly>{{ "700.1.1" }}</textarea>
                </div>
                <div class="col-3 mb-3">
                    <textarea name="nama" style="color: black; background-color:white" class="form-control" readonly>{{ $pengawasan['noSurat'] }}</textarea>
                </div>
                <div class="col-3 mb-3">
                <textarea name="nama" style="color: black; background-color:white" class="form-control" readonly>{{"03/2025" }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-3 mt-2">
                    Jenis Pengawasan
                </div>
                <div class="col-9">
                <textarea name="nama" style="color: black; background-color:white" class="form-control" readonly>{{ $pengawasan['nama_jenispengawasan'] }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-3 mt-3">
                    Obrik Pengawasan
                </div>
                <div class="col-9 mt-3">
                <textarea name="nama" style="color: black; background-color:white" class="form-control" readonly>{{ $pengawasan['nama_obrik'] }}</textarea>
                </div>
            </div>
                <div class="row">
                <div class="col-3 mt-3">
                    Tanggal Pelaksanaan
                </div>
                <div class="col-3 mt-3">
                <textarea name="nama" style="color: black; background-color:white" class="form-control" readonly>{{ $pengawasan['tanggalAwalPenugasan'] }}</textarea>
                </div>
                <div class="col-3 mt-3">
                    s/d
                </div>
                <div class="col-3 mt-3">
                <textarea name="nama" style="color: black; background-color:white" class="form-control" readonly>{{ $pengawasan['tanggalAkhirPenugasan'] }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-3 mt-3">
                    <label for="">Status LHP </label>
                </div>
                <div class="col-9 mt-3">
                    <textarea name="nama" style="color: black; background-color:white" class="form-control" readonly>{{ 'Belum Jadi' }}</textarea>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card mb-4" style="width: 100%;">
    <div class="card-header">Data Pengawasan</div>
    <div class="card-body">
        {{-- <form action="{{ url('/jabatan_baru'.$penugasan['id']) }}" method="post" enctype="multipart/form-data"> --}}
            @method('post')
            @csrf
            <div class="row">
                <div class="col-4 mb-3">
                    <label for="">Tanggal Surat Keluar </label>
                    <input type="date" name="tglkeluar" style="color: black; background-color:white" class="form-control" value="{{ $pengawasan['tglkeluar'] }}"  >
                </div>
                 <div class="col-4 mb-3">
                    <label for="">Tipe Rekomendasi </label>
                    <select name="tipe" id="" class="form-control" style="color: black; background-color:white">
                        <option value="Rekomendasi" @if ($pengawasan['tipe']=='Rekomendasi')selected='selected' @endif >Rekomendasi</option>
                        <option value="TemuandanRekomendasi" @if ($pengawasan['tipe']=='TemuandanRekomendasi')selected='selected' @endif >Temuan dan Rekomendasi</option>
                    </select>
                </div>
                <div class="col-4 mb-3">
                    <label for="">Jenis Pemeriksaan </label>
                     <select name="jenis" id="" class="form-control" style="color: black; background-color:white">
                        <option value="pdtt" @if ($pengawasan['jenis']=='pdtt')selected='selected' @endif>PDTT</option>
                        <option value="nspk" @if ($pengawasan['jenis']=='nspk')selected='selected' @endif>NSPK</option>
                     </select>
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-3">
                    <label for="">Wilayah </label>
                     <select name="wilayah" id="" class="form-control" style="color: black; background-color:white">
                        <option value="wilayah1" @if ($pengawasan['wilayah']=='wilayah1')selected='selected' @endif>Wilayah 1</option>
                        <option value="wilayah2" @if ($pengawasan['wilayah']=='wilayah2')selected='selected' @endif>Wilayah 2</option>
                     </select>
                </div>
                <div class="col-6 mb-3">
                    <label for="">Pemeriksa </label>
                     <select name="pemeriksa" id="" class="form-control" style="color: black; background-color:white">
                        <option value="auditor" @if ($pengawasan['pemeriksa']=='auditor')selected='selected' @endif>Auditor</option>
                        <option value="ppupd"   @if ($pengawasan['pemeriksa']=='ppupd')selected='selected' @endif>PPUPD</option>
                     </select>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card" id="card" style="width: 100%">
<div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
        <span><i class="fas fa-list-alt"></i> Tambah Rekomendasi</span>
        <div class="text-end">
            <small class="text-muted">
                <i class="fas fa-info-circle"></i>
                Format: 1 Temuan = 3 Baris
                <span class="badge bg-warning text-dark">Rekomendasi</span> +
                <span class="badge bg-info">Sub 1</span> +
                <span class="badge bg-secondary">Sub 2</span>
            </small>
        </div>
    </div>
</div>
<div class="card-body">
         <form action="{{ url('adminTL/rekom/') }}" method="post" enctype="multipart/form-data">
           @method('POST')
           @csrf
           <input type="hidden" name="id_pengawasan" value="{{ $pengawasan['id'] }}">
           <input type="hidden" name="id_penugasan" value="{{ $pengawasan['id_penugasan'] }}">

           <div class="table-responsive">
           <table class="table table-bordered" id="rekomendasi-table">
            <thead class="table-primary">
              <tr>
                <th style="width: 10%;">Kode Temuan</th>
                <th style="width: 20%;">Nama Temuan</th>
                <th style="width: 30%;">Field</th>
                <th style="width: 40%;">Value</th>
              </tr>
            </thead>
            <tbody>
                @if(isset($data) && count($data) > 0)
                    @foreach($data as $parentIndex => $parent)
                        <!-- Temuan Header Row -->
                        <tr class="temuan-header" style="background-color: #fff3cd; border-top: 3px solid #000;">
                            <td rowspan="3" class="align-middle text-center" style="background-color: #ffeaa7; border-right: 3px solid #000; font-weight: bold; font-size: 1.1em; vertical-align: middle;">
                                {{ $parentIndex + 1 }}
                            </td>
                            <td rowspan="3" class="align-middle" style="background-color: #fff3cd; border-right: 3px solid #000; font-weight: bold; font-size: 1em; vertical-align: middle;">
                                {{ $parent->nama_temuan ?? 'Temuan '.($parentIndex + 1) }}
                            </td>
                            <td style="background-color: #fff3cd;">
                                <textarea class="form-control" rows="4" name="tipeA[{{ $parentIndex }}][rekomendasi]" placeholder="Masukkan rekomendasi..." style="border: none; background-color: transparent; resize: none; font-size: 0.9rem;">{{ $parent->rekomendasi }}</textarea>
                            </td>
                            <td style="background-color: #fff3cd;">
                                <textarea class="form-control" rows="4" name="tipeA[{{ $parentIndex }}][keterangan]" placeholder="Masukkan keterangan..." style="border: none; background-color: transparent; resize: none; font-size: 0.9rem;">{{ $parent->keterangan }}</textarea>
                            </td>
                            <td style="background-color: #fff3cd;">
                                <input type="text" class="form-control tanparupiah" name="tipeA[{{ $parentIndex }}][pengembalian]" value="{{ number_format($parent->pengembalian,0,',','.') }}" placeholder="0" style="border: none; background-color: transparent; text-align: center; font-weight: bold;">
                            </td>
                        </tr>

                        <!-- Additional Sub Rows for each Temuan -->
                        @if(isset($parent->sub) && $parent->sub->count() > 0)
                            @foreach($parent->sub->take(2) as $subIndex => $sub)
                                <tr class="temuan-sub-row" style="background-color: #f8f9fa;">
                                    <td style="background-color: #f8f9fa;">
                                        <textarea class="form-control" rows="4" name="tipeA[{{ $parentIndex }}][sub][{{ $subIndex }}][rekomendasi]" placeholder="Masukkan sub rekomendasi..." style="border: none; background-color: transparent; resize: none; font-size: 0.9rem;">{{ $sub->rekomendasi }}</textarea>
                                    </td>
                                    <td style="background-color: #f8f9fa;">
                                        <textarea class="form-control" rows="4" name="tipeA[{{ $parentIndex }}][sub][{{ $subIndex }}][keterangan]" placeholder="Masukkan keterangan sub..." style="border: none; background-color: transparent; resize: none; font-size: 0.9rem;">{{ $sub->keterangan }}</textarea>
                                    </td>
                                    <td style="background-color: #f8f9fa;">
                                        <input type="text" class="form-control tanparupiah" name="tipeA[{{ $parentIndex }}][sub][{{ $subIndex }}][pengembalian]" value="{{ number_format($sub->pengembalian,0,',','.') }}" placeholder="0" style="border: none; background-color: transparent; text-align: center; font-weight: bold;">
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <!-- Empty sub rows when no sub data exists -->
                            <tr class="temuan-sub-row" style="background-color: #f8f9fa;">
                                <td style="background-color: #f8f9fa;">
                                    <textarea class="form-control" rows="4" name="tipeA[{{ $parentIndex }}][sub][0][rekomendasi]" placeholder="Masukkan sub rekomendasi..." style="border: none; background-color: transparent; resize: none; font-size: 0.9rem;"></textarea>
                                </td>
                                <td style="background-color: #f8f9fa;">
                                    <textarea class="form-control" rows="4" name="tipeA[{{ $parentIndex }}][sub][0][keterangan]" placeholder="Masukkan keterangan sub..." style="border: none; background-color: transparent; resize: none; font-size: 0.9rem;"></textarea>
                                </td>
                                <td style="background-color: #f8f9fa;">
                                    <input type="text" class="form-control tanparupiah" name="tipeA[{{ $parentIndex }}][sub][0][pengembalian]" placeholder="0" style="border: none; background-color: transparent; text-align: center; font-weight: bold;">
                                </td>
                            </tr>
                            <tr class="temuan-sub-row" style="background-color: #f8f9fa;">
                                <td style="background-color: #f8f9fa;">
                                    <textarea class="form-control" rows="4" name="tipeA[{{ $parentIndex }}][sub][1][rekomendasi]" placeholder="Masukkan sub rekomendasi..." style="border: none; background-color: transparent; resize: none; font-size: 0.9rem;"></textarea>
                                </td>
                                <td style="background-color: #f8f9fa;">
                                    <textarea class="form-control" rows="4" name="tipeA[{{ $parentIndex }}][sub][1][keterangan]" placeholder="Masukkan keterangan sub..." style="border: none; background-color: transparent; resize: none; font-size: 0.9rem;"></textarea>
                                </td>
                                <td style="background-color: #f8f9fa;">
                                    <input type="text" class="form-control tanparupiah" name="tipeA[{{ $parentIndex }}][sub][1][pengembalian]" placeholder="0" style="border: none; background-color: transparent; text-align: center; font-weight: bold;">
                                </td>
                            </tr>
                        @endif

                        @if(count($parent->sub ?? []) == 1)
                            <!-- Add second empty sub row if only one sub exists -->
                            <tr class="temuan-sub-row" style="background-color: #f8f9fa;">
                                <td style="background-color: #f8f9fa;">
                                    <textarea class="form-control" rows="4" name="tipeA[{{ $parentIndex }}][sub][1][rekomendasi]" placeholder="Masukkan sub rekomendasi..." style="border: none; background-color: transparent; resize: none; font-size: 0.9rem;"></textarea>
                                </td>
                                <td style="background-color: #f8f9fa;">
                                    <textarea class="form-control" rows="4" name="tipeA[{{ $parentIndex }}][sub][1][keterangan]" placeholder="Masukkan keterangan sub..." style="border: none; background-color: transparent; resize: none; font-size: 0.9rem;"></textarea>
                                </td>
                                <td style="background-color: #f8f9fa;">
                                    <input type="text" class="form-control tanparupiah" name="tipeA[{{ $parentIndex }}][sub][1][pengembalian]" placeholder="0" style="border: none; background-color: transparent; text-align: center; font-weight: bold;">
                                </td>
                            </tr>
                        @endif

                        <!-- Action Row -->
                        <tr class="action-row" style="background-color: #e7f3ff;">
                            <td colspan="5" class="text-center py-3" style="background-color: #e7f3ff; border-top: 2px solid #007bff;">
                                <button type="button" class="btn btn-primary btn-sm me-2" onclick="addTemuan()" title="Tambah Temuan Baru">
                                    <i class="fa-solid fa-plus"></i> Tambah Temuan
                                </button>
                                @if($parentIndex > 0 || count($data) > 1)
                                <button type="button" class="btn btn-danger btn-sm" onclick="removeTemuan({{ $parentIndex }})" title="Hapus Temuan">
                                    <i class="fa-solid fa-minus"></i> Hapus Temuan
                                </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <!-- Default empty temuan when no data -->
                    <tr class="temuan-row" data-temuan="0">
                        <td rowspan="3" class="align-middle text-center" style="background-color: #007bff; color: white; font-weight: bold; font-size: 1.1em; border: 2px solid #000;">
                            1
                        </td>
                        <td rowspan="3" class="align-middle" style="background-color: #007bff; color: white; font-weight: bold; font-size: 1em; border: 2px solid #000;">
                            Temuan 1
                        </td>
                        <td style="background-color: #007bff; color: white; font-weight: bold; text-align: center; border: 2px solid #000; padding: 12px;">
                            Rekomendasi
                        </td>
                        <td style="background-color: white; border: 2px solid #000; padding: 8px;">
                            <textarea class="form-control" rows="3" name="tipeA[0][rekomendasi]" placeholder="value" style="border: none; background-color: transparent; resize: none; font-size: 0.9rem;"></textarea>
                        </td>
                    </tr>
                    <tr class="temuan-row">
                        <td style="background-color: #007bff; color: white; font-weight: bold; text-align: center; border: 2px solid #000; padding: 12px;">
                            Keterangan
                        </td>
                        <td style="background-color: white; border: 2px solid #000; padding: 8px;">
                            <textarea class="form-control" rows="3" name="tipeA[0][keterangan]" placeholder="value" style="border: none; background-color: transparent; resize: none; font-size: 0.9rem;"></textarea>
                        </td>
                    </tr>
                    <tr class="temuan-row">
                        <td style="background-color: #007bff; color: white; font-weight: bold; text-align: center; border: 2px solid #000; padding: 12px;">
                            Pengembalian
                        </td>
                        <td style="background-color: white; border: 2px solid #000; padding: 8px;">
                            <input type="text" class="form-control tanparupiah" name="tipeA[0][pengembalian]" placeholder="value" style="border: none; background-color: transparent; text-align: center; font-weight: bold;">
                        </td>
                    </tr>
                    <!-- Action Row -->
                    <tr class="action-row" style="background-color: #e7f3ff;">
                        <td colspan="4" class="text-center py-3" style="background-color: #e7f3ff; border-top: 2px solid #007bff;">
                            <button type="button" class="btn btn-primary btn-sm" onclick="addTemuan()" title="Tambah Temuan Baru">
                                <i class="fa-solid fa-plus"></i> Tambah Temuan
                            </button>
                        </td>
                    </tr>
                @endif
            </tbody>
          </table>
          </div>

          <div class="text-end mt-3">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-save"></i> Submit Rekomendasi
            </button>
          </div>
         </form>
</div>
</div>

<div class="card mt-3" style="width: 100%; ">
    <div class="card-header">Upload Data Dukung</div>
    <div class="card-body">
        <form id="uploadForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_pengawasan" value="{{ $pengawasan['id'] }}">
            <input type="hidden" name="id_penugasan" value="{{ $pengawasan['id_penugasan'] }}">

            <div class="row">
                <div class="col-12">
                    <input type="file" id="fileUpload" multiple placeholder="choose file or browse" class="form-control" accept=".jpg,.jpeg,.png,.pdf,.svg,.zip,.docx,.xlsx,.doc,.xls,.ppt,.pptx"/>
                </div>
            </div>
            <button type="button" onclick="uploadFiles()" class="mt-3 btn btn-info">
                <i class="fas fa-upload"></i> Upload
            </button>
        </form>

        <!-- Progress container -->
        <div class="mt-4" id="uploadProgress" style="display: none;">
            <h6>Upload Progress:</h6>
            <div id="progressBarsContainer">
                <!-- Progress bars will be dynamically added here -->
            </div>
        </div>

        <!-- Upload status -->
        <div id="uploadStatus" class="mt-3"></div>

        <br>
    </div>
</div>

<div class="card mt-3" style="width: 100%; ">
    <div class="card-header">Berkas Data Dukung</div>
    <div class="card-body">
        @if(isset($uploadedFiles) && $uploadedFiles->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama File</th>
                            <th>Tanggal Upload</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($uploadedFiles as $key => $file)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <i class="fas fa-file"></i>
                                {{ basename($file->nama_file) }}
                            </td>
                            <td>{{ $file->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ asset($file->nama_file) }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                                <a href="{{ asset($file->nama_file) }}" download class="btn btn-sm btn-success">
                                    <i class="fas fa-download"></i> Download
                                </a>
                                <button type="button" onclick="deleteUploadedFile({{ $file->id }}, this)" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center text-muted py-4">
                <i class="fas fa-file-upload fa-3x mb-3"></i>
                <p>Belum ada file yang diupload</p>
            </div>
        @endif
    </div>
</div>

    <script>
        let uploadedFiles = []; // Array to store uploaded file information
        let parentCounter = 0;
        let subCounter = {};
        let subSubCounter = {};

        // Initialize counters based on existing data
        $(document).ready(function() {
            // Count existing temuan (each temuan has 3 rows + 1 action row)
            parentCounter = $('.temuan-row[data-temuan]').length;

            // Initialize currency formatting
            formatCurrency();
        });        // Currency formatting function
        function formatCurrency() {
            $('.tanparupiah').on('input', function() {
                let value = this.value.replace(/[^0-9]/g, '');
                if (value) {
                    this.value = parseInt(value).toLocaleString('id-ID');
                } else {
                    this.value = '';
                }
            });
        }

        // Add new temuan (3 rows in new format)
        function addTemuan() {
            const newTemuanIndex = parentCounter;

            const newRows = `
                <!-- Temuan Rekomendasi Row -->
                <tr class="temuan-row" data-temuan="${newTemuanIndex}">
                    <td rowspan="3" class="align-middle text-center" style="background-color: #007bff; color: white; font-weight: bold; font-size: 1.1em; border: 2px solid #000;">
                        ${newTemuanIndex + 1}
                    </td>
                    <td rowspan="3" class="align-middle" style="background-color: #007bff; color: white; font-weight: bold; font-size: 1em; border: 2px solid #000;">
                        Temuan ${newTemuanIndex + 1}
                    </td>
                    <td style="background-color: #007bff; color: white; font-weight: bold; text-align: center; border: 2px solid #000; padding: 12px;">
                        Rekomendasi
                    </td>
                    <td style="background-color: white; border: 2px solid #000; padding: 8px;">
                        <textarea class="form-control" rows="3" name="tipeA[${newTemuanIndex}][rekomendasi]" placeholder="value" style="border: none; background-color: transparent; resize: none; font-size: 0.9rem;"></textarea>
                    </td>
                </tr>
                <tr class="temuan-row">
                    <td style="background-color: #007bff; color: white; font-weight: bold; text-align: center; border: 2px solid #000; padding: 12px;">
                        Keterangan
                    </td>
                    <td style="background-color: white; border: 2px solid #000; padding: 8px;">
                        <textarea class="form-control" rows="3" name="tipeA[${newTemuanIndex}][keterangan]" placeholder="value" style="border: none; background-color: transparent; resize: none; font-size: 0.9rem;"></textarea>
                    </td>
                </tr>
                <tr class="temuan-row">
                    <td style="background-color: #007bff; color: white; font-weight: bold; text-align: center; border: 2px solid #000; padding: 12px;">
                        Pengembalian
                    </td>
                    <td style="background-color: white; border: 2px solid #000; padding: 8px;">
                        <input type="text" class="form-control tanparupiah" name="tipeA[${newTemuanIndex}][pengembalian]" placeholder="value" style="border: none; background-color: transparent; text-align: center; font-weight: bold;">
                    </td>
                </tr>
                <!-- Action Row -->
                <tr class="action-row" style="background-color: #e7f3ff;">
                    <td colspan="4" class="text-center py-3" style="background-color: #e7f3ff; border-top: 2px solid #007bff;">
                        <button type="button" class="btn btn-primary btn-sm me-2" onclick="addTemuan()" title="Tambah Temuan Baru">
                            <i class="fa-solid fa-plus"></i> Tambah Temuan
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeTemuan(${newTemuanIndex})" title="Hapus Temuan">
                            <i class="fa-solid fa-minus"></i> Hapus Temuan
                        </button>
                    </td>
                </tr>
            `;

            $('#rekomendasi-table tbody').append(newRows);

            parentCounter++;

            // Re-initialize currency formatting for new inputs
            formatCurrency();
        }

        // Remove temuan (removes all 4 rows: 3 temuan rows + action row)
        function removeTemuan(temuanIndex) {
            if (confirm('Apakah Anda yakin ingin menghapus temuan ini beserta semua rekomendasinya?')) {
                // Find the first row for this temuan
                const temuanRow = $(`.temuan-row[data-temuan="${temuanIndex}"]`);
                if (temuanRow.length) {
                    // Remove the first temuan row and the next 3 rows (2 more temuan rows + action row)
                    temuanRow.remove();
                    temuanRow.next('.temuan-row').remove();
                    temuanRow.next('.temuan-row').remove();
                    temuanRow.next('.action-row').remove();
                }
            }
        }

        // Legacy functions (keeping for compatibility but they may not be used in new format)
        function addSubRekomendasi(parentIndex) {
        function addSubRekomendasi(parentIndex) {
            const currentSubIndex = subCounter[parentIndex] || 0;

            const newRow = `
                <tr class="table-info sub-row" data-parent="${parentIndex}" data-sub="${currentSubIndex}" style="background-color: #d1ecf1;">
                    <td class="align-middle" style="background-color: #bee5eb;">
                        <span class="badge bg-info px-2 py-1" style="font-size: 0.85em;">Sub</span>
                    </td>
                    <td>
                        <textarea class="form-control" rows="2" name="tipeA[${parentIndex}][sub][${currentSubIndex}][rekomendasi]" placeholder="Sub rekomendasi..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-control" rows="2" name="tipeA[${parentIndex}][sub][${currentSubIndex}][keterangan]" placeholder="Keterangan sub..."></textarea>
                    </td>
                    <td>
                        <input type="text" class="form-control tanparupiah" name="tipeA[${parentIndex}][sub][${currentSubIndex}][pengembalian]" placeholder="0">
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-success btn-sm" onclick="addSubSubRekomendasi(${parentIndex}, ${currentSubIndex})" title="Tambah Sub-Sub">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm mt-1" onclick="removeRow(this)" title="Hapus Sub">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                    </td>
                </tr>
            `;

            // Find the parent row and add the sub row after it (and any existing sub rows)
            const parentRow = $(`.parent-row[data-parent="${parentIndex}"]`);
            const lastSubRow = parentRow.nextAll(`.sub-row[data-parent="${parentIndex}"]:last, .subsub-row[data-parent="${parentIndex}"]:last`).last();

            if (lastSubRow.length) {
                lastSubRow.after(newRow);
            } else {
                parentRow.after(newRow);
            }

            // Initialize sub-sub counter for this sub
            if (!subSubCounter[parentIndex]) {
                subSubCounter[parentIndex] = {};
            }
            subSubCounter[parentIndex][currentSubIndex] = 0;

            subCounter[parentIndex] = currentSubIndex + 1;

            // Re-initialize currency formatting
            formatCurrency();
        }

        // Add sub-sub rekomendasi
        function addSubSubRekomendasi(parentIndex, subIndex) {
            if (!subSubCounter[parentIndex]) {
                subSubCounter[parentIndex] = {};
            }
            if (!subSubCounter[parentIndex][subIndex]) {
                subSubCounter[parentIndex][subIndex] = 0;
            }

            const currentSubSubIndex = subSubCounter[parentIndex][subIndex];

            const newRow = `
                <tr class="table-light subsub-row" data-parent="${parentIndex}" data-sub="${subIndex}" data-subsub="${currentSubSubIndex}" style="background-color: #f8f9fa;">
                    <td class="align-middle" style="background-color: #e9ecef;">
                        <span class="badge bg-secondary px-2 py-1" style="font-size: 0.8em;">Sub1</span>
                    </td>
                    <td>
                        <textarea class="form-control" rows="2" name="tipeA[${parentIndex}][sub][${subIndex}][sub][${currentSubSubIndex}][rekomendasi]" placeholder="Sub-sub rekomendasi..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-control" rows="2" name="tipeA[${parentIndex}][sub][${subIndex}][sub][${currentSubSubIndex}][keterangan]" placeholder="Keterangan sub-sub..."></textarea>
                    </td>
                    <td>
                        <input type="text" class="form-control tanparupiah" name="tipeA[${parentIndex}][sub][${subIndex}][sub][${currentSubSubIndex}][pengembalian]" placeholder="0">
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)" title="Hapus Sub-Sub">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                    </td>
                </tr>
            `;

            // Find the sub row and add the sub-sub row after it (and any existing sub-sub rows of the same sub)
            const subRow = $(`.sub-row[data-parent="${parentIndex}"][data-sub="${subIndex}"]`);
            const lastSubSubRow = subRow.nextAll(`.subsub-row[data-parent="${parentIndex}"][data-sub="${subIndex}"]:last`).last();

            if (lastSubSubRow.length) {
                lastSubSubRow.after(newRow);
            } else {
                subRow.after(newRow);
            }

            subSubCounter[parentIndex][subIndex] = currentSubSubIndex + 1;

            // Re-initialize currency formatting
            formatCurrency();
        }

        // Remove row (sub or sub-sub)
        function removeRow(button) {
            if (confirm('Apakah Anda yakin ingin menghapus baris ini?')) {
                $(button).closest('tr').remove();
            }
        }

        // Remove parent row and all its children
        function removeParentRow(button) {
            if (confirm('Apakah Anda yakin ingin menghapus rekomendasi utama ini beserta semua sub-rekomendasinya?')) {
                const parentRow = $(button).closest('tr');
                const parentIndex = parentRow.data('parent');

                // Remove all related sub and sub-sub rows
                $(`.sub-row[data-parent="${parentIndex}"], .subsub-row[data-parent="${parentIndex}"]`).remove();

                // Remove the parent row
                parentRow.remove();
            }
        }

        function uploadFiles() {
            var fileInput = document.getElementById('fileUpload');
            var files = fileInput.files;

            if (files.length === 0) {
                alert('Please select files to upload');
                return;
            }

            // Show progress container
            document.getElementById('uploadProgress').style.display = 'block';

            // Clear previous progress bars
            document.getElementById('progressBarsContainer').innerHTML = '';
            document.getElementById('uploadStatus').innerHTML = '';

            var allowedExtensions = ['.jpg', '.jpeg', '.png', '.pdf', '.svg', '.zip', '.docx', '.xlsx', '.doc', '.xls', '.ppt', '.pptx'];
            var validFiles = [];

            // Validate files first
            for (var i = 0; i < files.length; i++) {
                var fileExtension = files[i].name.substring(files[i].name.lastIndexOf('.')).toLowerCase();

                if (allowedExtensions.includes(fileExtension)) {
                    validFiles.push(files[i]);
                } else {
                    alert('Invalid file type: ' + files[i].name + ' (' + fileExtension + ')');
                }
            }

            if (validFiles.length === 0) {
                document.getElementById('uploadProgress').style.display = 'none';
                return;
            }

            // Upload each valid file
            for (var i = 0; i < validFiles.length; i++) {
                uploadFile(validFiles[i], i + 1);
            }
        }

        function uploadFile(file, index) {
            console.log('Starting upload for file:', file.name, 'Size:', file.size);

            var formData = new FormData();
            formData.append('file', file);
            formData.append('_token', document.querySelector('input[name="_token"]').value);
            formData.append('id_pengawasan', document.querySelector('input[name="id_pengawasan"]').value);
            formData.append('id_penugasan', document.querySelector('input[name="id_penugasan"]').value);

            console.log('FormData prepared:', {
                file_name: file.name,
                file_size: file.size,
                id_pengawasan: document.querySelector('input[name="id_pengawasan"]').value,
                id_penugasan: document.querySelector('input[name="id_penugasan"]').value
            });

            // Create progress bar container
            var progressContainer = document.createElement('div');
            progressContainer.className = 'mb-3 p-3 border rounded';
            progressContainer.id = 'progress_' + index;

            // File info row
            var fileInfoRow = document.createElement('div');
            fileInfoRow.className = 'd-flex justify-content-between align-items-center mb-2';

            var fileName = document.createElement('span');
            fileName.className = 'fw-bold';
            fileName.textContent = file.name;

            var fileSize = document.createElement('span');
            fileSize.className = 'text-muted small';
            fileSize.textContent = formatFileSize(file.size);

            var actionButtons = document.createElement('div');

            fileInfoRow.appendChild(fileName);
            fileInfoRow.appendChild(fileSize);
            fileInfoRow.appendChild(actionButtons);

            // Progress bar
            var progressWrapper = document.createElement('div');
            progressWrapper.className = 'progress';
            progressWrapper.style.height = '25px';

            var progressBar = document.createElement('div');
            progressBar.className = 'progress-bar progress-bar-striped progress-bar-animated';
            progressBar.setAttribute('role', 'progressbar');
            progressBar.style.width = '0%';
            progressBar.textContent = '0%';

            progressWrapper.appendChild(progressBar);

            // Status message
            var statusDiv = document.createElement('div');
            statusDiv.className = 'mt-2 small text-muted';
            statusDiv.textContent = 'Preparing upload...';

            progressContainer.appendChild(fileInfoRow);
            progressContainer.appendChild(progressWrapper);
            progressContainer.appendChild(statusDiv);

            document.getElementById('progressBarsContainer').appendChild(progressContainer);

            var xhr = new XMLHttpRequest();

            // Upload progress
            xhr.upload.addEventListener('progress', function(event) {
                if (event.lengthComputable) {
                    var percent = Math.round((event.loaded / event.total) * 100);
                    progressBar.style.width = percent + '%';
                    progressBar.textContent = percent + '%';

                    if (percent < 100) {
                        statusDiv.textContent = 'Uploading... ' + formatFileSize(event.loaded) + ' / ' + formatFileSize(event.total);
                        progressBar.className = 'progress-bar progress-bar-striped progress-bar-animated bg-info';
                    }
                }
            });

            // Upload complete
            xhr.addEventListener('load', function(event) {
                try {
                    var response = JSON.parse(event.target.responseText);

                    if (response.success) {
                        progressBar.className = 'progress-bar bg-success';
                        progressBar.style.width = '100%';
                        progressBar.textContent = '100%';
                        statusDiv.innerHTML = '<i class="fas fa-check-circle text-success"></i> Upload successful';

                        // Add delete button
                        var deleteBtn = document.createElement('button');
                        deleteBtn.className = 'btn btn-sm btn-outline-danger';
                        deleteBtn.innerHTML = '<i class="fas fa-times"></i>';
                        deleteBtn.onclick = function() {
                            deleteFile(response.file_id, progressContainer);
                        };
                        actionButtons.appendChild(deleteBtn);

                        // Store file info
                        uploadedFiles.push({
                            id: response.file_id,
                            original_name: file.name,
                            stored_name: response.stored_name,
                            path: response.path,
                            size: file.size
                        });

                        console.log('File uploaded successfully:', response);

                        // Refresh page after successful upload to show the new file in the list
                        setTimeout(function() {
                            location.reload();
                        }, 1000);

                    } else {
                        throw new Error(response.message || 'Upload failed');
                    }
                } catch (error) {
                    progressBar.className = 'progress-bar bg-danger';
                    progressBar.style.width = '100%';
                    progressBar.textContent = 'Error';
                    statusDiv.innerHTML = '<i class="fas fa-exclamation-circle text-danger"></i> ' + error.message;
                    console.error('Upload error:', error);
                }
            });

            // Upload error
            xhr.addEventListener('error', function(event) {
                progressBar.className = 'progress-bar bg-danger';
                progressBar.style.width = '100%';
                progressBar.textContent = 'Error';
                statusDiv.innerHTML = '<i class="fas fa-exclamation-circle text-danger"></i> Network error occurred';
                console.error('Network error:', event);
            });

            statusDiv.textContent = 'Starting upload...';
            xhr.open('POST', '{{ url("adminTL/rekom/upload-file") }}', true);
            xhr.send(formData);
        }

        function deleteFile(fileId, progressContainer) {
            if (!confirm('Are you sure you want to delete this file?')) {
                return;
            }

            var formData = new FormData();
            formData.append('file_id', fileId);
            formData.append('_token', document.querySelector('input[name="_token"]').value);

            var xhr = new XMLHttpRequest();

            xhr.addEventListener('load', function(event) {
                try {
                    var response = JSON.parse(event.target.responseText);

                    if (response.success) {
                        progressContainer.remove();

                        // Remove from uploadedFiles array
                        uploadedFiles = uploadedFiles.filter(file => file.id !== fileId);

                        console.log('File deleted successfully');
                    } else {
                        alert('Error deleting file: ' + response.message);
                    }
                } catch (error) {
                    alert('Error deleting file: ' + error.message);
                }
            });

            xhr.addEventListener('error', function(event) {
                alert('Network error occurred while deleting file');
            });

            xhr.open('POST', '{{ url("adminTL/rekom/delete-file") }}', true);
            xhr.send(formData);
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';

            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));

            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Clear file input after successful uploads
        document.getElementById('fileUpload').addEventListener('change', function() {
            // Reset the upload status when new files are selected
            document.getElementById('uploadProgress').style.display = 'none';
            document.getElementById('uploadStatus').innerHTML = '';
        });

        // Delete uploaded file from database
        function deleteUploadedFile(fileId, buttonElement) {
            if (!confirm('Apakah Anda yakin ingin menghapus file ini?')) {
                return;
            }

            var formData = new FormData();
            formData.append('file_id', fileId);
            formData.append('_token', document.querySelector('input[name="_token"]').value);

            // Disable button during request
            buttonElement.disabled = true;
            buttonElement.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';

            var xhr = new XMLHttpRequest();

            xhr.addEventListener('load', function(event) {
                try {
                    var response = JSON.parse(event.target.responseText);

                    if (response.success) {
                        // Remove the table row
                        var row = buttonElement.closest('tr');
                        row.remove();

                        // Show success message
                        alert('File berhasil dihapus');

                        // Refresh page to update file list
                        location.reload();
                    } else {
                        alert('Error: ' + response.message);
                        buttonElement.disabled = false;
                        buttonElement.innerHTML = '<i class="fas fa-trash"></i> Hapus';
                    }
                } catch (error) {
                    alert('Error: ' + error.message);
                    buttonElement.disabled = false;
                    buttonElement.innerHTML = '<i class="fas fa-trash"></i> Hapus';
                }
            });

            xhr.addEventListener('error', function(event) {
                alert('Network error occurred while deleting file');
                buttonElement.disabled = false;
                buttonElement.innerHTML = '<i class="fas fa-trash"></i> Hapus';
            });

            xhr.open('POST', '{{ url("adminTL/rekom/delete-file") }}', true);
            xhr.send(formData);
        }
    </script>






@endsection
