@extends('template')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

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

    table #baris1 .kolom1{
        margin-left: 20px;
    }
    table #baris .kolom{
        margin-left: 20px;
    }
    table #baris2 .kolom2{
        margin-left: 40px;
    }

    /* Styling untuk nested sub-rekomendasi */
    .sub-level-1 {
        background-color: #f8f9fa;
        border-left: 3px solid #007bff;
    }

    .sub-level-1 .rekomendasi-text {
        margin-left: 20px;
        font-style: italic;
    }

    .sub-level-2 {
        background-color: #e9ecef;
        border-left: 3px solid #28a745;
    }

    .sub-level-2 .rekomendasi-text {
        margin-left: 40px;
        font-style: italic;
        font-size: 0.9em;
    }

    .sub-level-3 {
        background-color: #dee2e6;
        border-left: 3px solid #ffc107;
    }

    .sub-level-3 .rekomendasi-text {
        margin-left: 60px;
        font-style: italic;
        font-size: 0.85em;
    }

    /* Styling untuk rekomendasi section */
    .rekomendasi-section {
        animation: slideInUp 0.5s ease-out;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .border-success {
        border-color: #198754 !important;
    }

    #add_btn {
        transition: all 0.3s ease;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 600;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    #add_btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .remove-rekom-btn {
        transition: all 0.2s ease;
    }

    .remove-rekom-btn:hover {
        background-color: rgba(255, 255, 255, 0.2) !important;
    }

    /* Enhanced table styling */
    .table-bordered {
        border: 2px solid #dee2e6;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6;
    }

    .table-light {
        background-color: #f8f9fa;
    }

    /* Button styling improvements */
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        border-radius: 0.2rem;
    }

    .btn-success {
        background-color: #198754;
        border-color: #198754;
    }

    .btn-success:hover {
        background-color: #146c43;
        border-color: #13653f;
    }

    .btn-info {
        background-color: #0dcaf0;
        border-color: #0dcaf0;
    }

    .btn-info:hover {
        background-color: #31d2f2;
        border-color: #25cff2;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #bb2d3b;
        border-color: #b02a37;
    }

    /* Form control improvements */
    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    /* Card improvements */
    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: 1px solid rgba(0, 0, 0, 0.125);
    }

    .card-header {
        background-color: rgba(0, 0, 0, 0.03);
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        font-weight: 600;
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

<div class="card mb-4" id="card" style="width: 100%">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Rekomendasi</span>
        <button type="button" class="btn btn-primary btn-sm" id="add_btn">
            <i class="fa-solid fa-plus"></i> Tambah Rekomendasi
        </button>
    </div>
    <div class="card-body">

        {{-- Display Success/Error Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ url('adminTL/rekom/') }}" method="post" enctype="multipart/form-data">
           @method('POST')
           @csrf
           <input type="hidden" name="id_pengawasan" value="{{ $pengawasan['id'] }}">
           <input type="hidden" name="id_penugasan" value="{{ $pengawasan['id_penugasan'] }}">

           <table class="table table-bordered" id="tabel1">
            <thead class="table-light">
              <tr>
                <th scope="col" style="width: 8%">Nomor</th>
                <th scope="col" style="width: 35%">NAMA REKOMENDASI <span class="text-danger">*</span></th>
                <th scope="col" style="width: 25%">KETERANGAN REKOMENDASI</th>
                <th scope="col" style="width: 20%">PENGEMBALIAN KEUANGAN</th>
                <th style="width: 12%">Aksi</th>
              </tr>
            </thead>
            <tbody class="body">
                @if(isset($data) && count($data) > 0)
                @foreach($data as $key => $item)
                <tr class="sub{{ $key }}" data-level="0" data-rekom-index="{{ $key }}">
                    <td class="nomor-cell">{{ $loop->iteration }}</td>
                    <td><textarea class="form-control" name="tipeA[{{ $key }}][rekomendasi]" required>{{ $item->rekomendasi }}</textarea></td>
                    <td><textarea class="form-control" name="tipeA[{{ $key }}][keterangan]">{{ $item->keterangan }}</textarea></td>
                    <td><input type="text" class="form-control tanparupiah"
                               name="tipeA[{{ $key }}][pengembalian]"
                               value="{{ number_format($item->pengembalian,0,',','.') }}"
                               placeholder="Rp. 0"></td>
                    <td>
                        <button type="button" data-level1="{{ $key }}" data-parentid="{{ $item->id }}" class="btn btn-success btn-sm add_rekom_btn" title="Tambah Rekomendasi">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        <button type="button" data-level1="{{ $key }}" data-parentid="{{ $item->id }}" class="btn btn-info btn-sm add_sub_btn" title="Tambah Sub Rekomendasi" id="add_btnEdit">
                            <i class="fa-solid fa-indent"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm remove_rekom_btn" title="Hapus">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                    </td>
                </tr>

                    @if(isset($item->sub))
                        @foreach($item->sub as $subKey => $subItem)
                            <tr class="sub-level-1" data-level="1" data-rekom-index="{{ $subKey }}" data-parent="{{ $key }}">
                                <td class="nomor-cell"></td>
                                <td>
                                    <div class="rekomendasi-text">
                                        <textarea class="form-control kolom1"
                                                name="tipeA[{{ $key }}][sub][{{ $subKey }}][rekomendasi]"
                                                required>{{ $subItem->rekomendasi }}</textarea>
                                    </div>
                                </td>
                                <td><textarea class="form-control kolom1"
                                        name="tipeA[{{ $key }}][sub][{{ $subKey }}][keterangan]">{{ $subItem->keterangan }}</textarea></td>
                                <td><input type="text" class="form-control kolom1 tanparupiah"
                                        name="tipeA[{{ $key }}][sub][{{ $subKey }}][pengembalian]"
                                        value="{{ number_format($subItem->pengembalian,0,',','.') }}"
                                        placeholder="Rp. 0"></td>
                                <td>
                                    <button type="button" data-level1="{{ $key }}" data-level2="{{ $subKey }}" data-parentid="{{ $subItem->id }}"
                                            class="btn btn-info btn-sm add_subsub_btn" title="Tambah Sub-Sub Rekomendasi" id="add_btnEdit1">
                                        <i class="fa-solid fa-indent"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm remove_rekom_btn" title="Hapus"><i class="fa-solid fa-minus"></i></button>
                                </td>
                            </tr>
                            @if(isset($subItem->sub))
                                @foreach($subItem->sub as $nestedKey => $nestedItem)
                                    <tr class="sub-level-2" data-level="2" data-rekom-index="{{ $nestedKey }}" data-parent="{{ $key }}_{{ $subKey }}">
                                        <td class="nomor-cell"></td>
                                        <td>
                                            <div class="rekomendasi-text">
                                                <textarea class="form-control kolom2"
                                                        name="tipeA[{{ $key }}][sub][{{ $subKey }}][sub][{{ $nestedKey }}][rekomendasi]"
                                                        required>{{ $nestedItem->rekomendasi }}</textarea>
                                            </div>
                                        </td>
                                        <td><textarea class="form-control kolom2"
                                                name="tipeA[{{ $key }}][sub][{{ $subKey }}][sub][{{ $nestedKey }}][keterangan]">{{ $nestedItem->keterangan }}</textarea></td>
                                        <td><input type="text" class="form-control kolom2 tanparupiah"
                                                name="tipeA[{{ $key }}][sub][{{ $subKey }}][sub][{{ $nestedKey }}][pengembalian]"
                                                value="{{ number_format($nestedItem->pengembalian,0,',','.') }}"
                                                placeholder="Rp. 0"></td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm remove_rekom_btn" title="Hapus"><i class="fa-solid fa-minus"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @else
                <tr class="sub0" data-level="0" data-rekom-index="0">
                    <td class="nomor-cell">1</td>
                    <td><textarea class="form-control" name="tipeA[0][rekomendasi]" required placeholder="Masukkan rekomendasi..."></textarea></td>
                    <td><textarea class="form-control" name="tipeA[0][keterangan]" placeholder="Keterangan rekomendasi..."></textarea></td>
                    <td><input type="text" class="form-control tanparupiah" name="tipeA[0][pengembalian]" placeholder="Rp. 0"></td>
                    <td>
                        <button type="button" data-level1="0" class="btn btn-success btn-sm add_rekom_btn" title="Tambah Rekomendasi"><i class="fa-solid fa-plus"></i></button>
                        <button type="button" data-level1="0" class="btn btn-info btn-sm add_sub_btn" title="Tambah Sub Rekomendasi" id="add_btn1"><i class="fa-solid fa-indent"></i></button>
                        <button type="button" class="btn btn-danger btn-sm remove_rekom_btn" title="Hapus"><i class="fa-solid fa-minus"></i></button>
                    </td>
                </tr>
                @endif
            </tbody>
          </table>

          <div class="mt-3">
              <button type="submit" class="btn btn-primary btn-lg">
                  <i class="fas fa-save"></i> Simpan Rekomendasi
              </button>
              <a href="{{ url('adminTL/rekom') }}" class="btn btn-secondary btn-lg ms-2">
                  <i class="fas fa-arrow-left"></i> Kembali
              </a>
          </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>


<script>
// Global variables
let rekomCounter = {{ count($data) > 0 ? count($data) : 1 }};
let subCounter = {};

// Format Rupiah function
function formatRupiah(angka) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return 'Rp. ' + rupiah;
}

// Function to renumber table with hierarchical numbering
function renumberTable(tbody) {
    var mainCounter = 1;
    var subCounters = {}; // Track sub-counters for each parent

    tbody.find('tr').each(function() {
        var row = $(this);
        var level = row.data('level') || 0;
        var numberCell = row.find('.nomor-cell, td:first');

        if (level === 0) {
            // Main recommendation
            numberCell.text(mainCounter);
            mainCounter++;
            subCounters[mainCounter - 2] = { level1: 0, level2: {} };
        } else if (level === 1) {
            // Sub-recommendation
            var parentIndex = 0; // Find parent index logic here
            if (!subCounters[parentIndex]) subCounters[parentIndex] = { level1: 0, level2: {} };
            subCounters[parentIndex].level1++;
            numberCell.text(mainCounter - 1 + '.' + subCounters[parentIndex].level1);
        } else if (level === 2) {
            // Sub-sub-recommendation
            var parentIndex = 0;
            var subIndex = 0;
            if (!subCounters[parentIndex]) subCounters[parentIndex] = { level1: 0, level2: {} };
            if (!subCounters[parentIndex].level2[subIndex]) subCounters[parentIndex].level2[subIndex] = 0;
            subCounters[parentIndex].level2[subIndex]++;
            numberCell.text((mainCounter - 1) + '.' + subCounters[parentIndex].level1 + '.' + subCounters[parentIndex].level2[subIndex]);
        }
    });
}

$(document).ready(function () {
    let index = {{ count($data) > 0 ? count($data) : 1 }};
    let index1 = 0;
    let index2 = 0;
    let indexEdit = 0;
    let indexEdit1 = 0;



    // Format rupiah on input
    $(document).on('keyup', '.tanparupiah', function (e) {
        let rupiah = formatRupiah($(this).val());
        $(this).val(rupiah);
    });

    // Add sub-sub recommendation (level 2)
    $(document).on('click', '.add_subsub_btn, #add_btnEdit1', function () {
        indexEdit1++;
        var html = '';
        var level1 = $(this).data('level1');
        var level2 = $(this).data('level2');
        var parentId = $(this).data('parentid');

        html += '<tr class="sub-level-2" data-level="2" data-rekom-index="' + indexEdit1 + '" data-parent="' + level1 + '_' + level2 + '">';
        html += '<input type="hidden" name="tipeA[' + level1 + '][sub][' + level2 + '][sub][' + indexEdit1 + '][parentid]" value="' + parentId + '">';
        html += '<td class="nomor-cell"></td>';
        html += '<td><div class="rekomendasi-text"><textarea class="form-control kolom2" name="tipeA[' + level1 + '][sub][' + level2 + '][sub][' + indexEdit1 + '][rekomendasi]" required placeholder="Sub-sub rekomendasi..."></textarea></div></td>';
        html += '<td><textarea class="form-control kolom2" name="tipeA[' + level1 + '][sub][' + level2 + '][sub][' + indexEdit1 + '][keterangan]" placeholder="Keterangan..."></textarea></td>';
        html += '<td><input type="text" class="form-control kolom2 tanparupiah" name="tipeA[' + level1 + '][sub][' + level2 + '][sub][' + indexEdit1 + '][pengembalian]" placeholder="Rp. 0"></td>';
        html += '<td><button type="button" class="btn btn-danger btn-sm remove_rekom_btn" title="Hapus"><i class="fa-solid fa-minus"></i></button></td>';
        html += '</tr>';

        $(this).closest('tr').after(html);
        renumberTable($(this).closest('tbody'));
    });



    // Add sub recommendation (level 1)
    $(document).on('click', '.add_sub_btn, #add_btnEdit', function () {
        indexEdit++;
        var html = '';
        var level1 = $(this).data('level1');
        var parentId = $(this).data('parentid');

        html += '<tr class="sub-level-1" data-level="1" data-rekom-index="' + indexEdit + '" data-parent="' + level1 + '">';
        html += '<input type="hidden" name="tipeA[' + level1 + '][sub][' + indexEdit + '][parentid]" value="' + parentId + '">';
        html += '<td class="nomor-cell"></td>';
        html += '<td><div class="rekomendasi-text"><textarea class="form-control kolom1" name="tipeA[' + level1 + '][sub][' + indexEdit + '][rekomendasi]" required placeholder="Sub rekomendasi..."></textarea></div></td>';
        html += '<td><textarea class="form-control kolom1" name="tipeA[' + level1 + '][sub][' + indexEdit + '][keterangan]" placeholder="Keterangan..."></textarea></td>';
        html += '<td><input type="text" class="form-control kolom1 tanparupiah" name="tipeA[' + level1 + '][sub][' + indexEdit + '][pengembalian]" placeholder="Rp. 0"></td>';
        html += '<td>';
        html += '<button type="button" data-level1="' + level1 + '" data-level2="' + indexEdit + '" class="btn btn-info btn-sm add_subsub_btn" title="Tambah Sub-Sub Rekomendasi"><i class="fa-solid fa-indent"></i></button> ';
        html += '<button type="button" class="btn btn-danger btn-sm remove_rekom_btn" title="Hapus"><i class="fa-solid fa-minus"></i></button>';
        html += '</td>';
        html += '</tr>';

        $(this).closest('tr').after(html);
        renumberTable($(this).closest('tbody'));
    });

    // Legacy support for add_btn1 (sub recommendation)
    $(document).on('click', '#add_btn1', function () {
        index1++;
        var html = '';
        var level1 = $(this).data('level1');

        html += '<tr class="sub-level-1" data-level="1" data-rekom-index="' + index1 + '" data-parent="' + level1 + '">';
        html += '<td class="nomor-cell"></td>';
        html += '<td><div class="rekomendasi-text"><textarea class="form-control kolom1" name="tipeA[' + level1 + '][sub][' + index1 + '][rekomendasi]" required placeholder="Sub rekomendasi..."></textarea></div></td>';
        html += '<td><textarea class="form-control kolom1" name="tipeA[' + level1 + '][sub][' + index1 + '][keterangan]" placeholder="Keterangan..."></textarea></td>';
        html += '<td><input type="text" class="form-control kolom1 tanparupiah" name="tipeA[' + level1 + '][sub][' + index1 + '][pengembalian]" placeholder="Rp. 0"></td>';
        html += '<td>';
        html += '<button type="button" data-level1="' + level1 + '" data-level2="' + index1 + '" class="btn btn-info btn-sm add_subsub_btn" title="Tambah Sub-Sub Rekomendasi" id="add_btn2"><i class="fa-solid fa-indent"></i></button> ';
        html += '<button type="button" class="btn btn-danger btn-sm remove_rekom_btn" title="Hapus"><i class="fa-solid fa-minus"></i></button>';
        html += '</td>';
        html += '</tr>';

        $(this).closest('tr.sub' + level1).after(html);
        renumberTable($(this).closest('tbody'));
    });
    // Add new recommendation row
    $(document).on('click', '.add_rekom_btn', function () {
        var tbody = $(this).closest('tbody');
        var rowNumber = tbody.find('tr[data-level="0"]').length + 1;

        var html = '';
        html += '<tr class="sub' + index + '" data-level="0" data-rekom-index="' + index + '">';
        html += '<td class="nomor-cell">' + rowNumber + '</td>';
        html += '<td><textarea class="form-control" name="tipeA[' + index + '][rekomendasi]" required placeholder="Masukkan rekomendasi..."></textarea></td>';
        html += '<td><textarea class="form-control" name="tipeA[' + index + '][keterangan]" placeholder="Keterangan rekomendasi..."></textarea></td>';
        html += '<td><input type="text" class="form-control tanparupiah" name="tipeA[' + index + '][pengembalian]" placeholder="Rp. 0"></td>';
        html += '<td>';
        html += '<button type="button" data-level1="' + index + '" class="btn btn-success btn-sm add_rekom_btn" title="Tambah Rekomendasi"><i class="fa-solid fa-plus"></i></button> ';
        html += '<button type="button" data-level1="' + index + '" class="btn btn-info btn-sm add_sub_btn" title="Tambah Sub Rekomendasi" id="add_btn1"><i class="fa-solid fa-indent"></i></button> ';
        html += '<button type="button" class="btn btn-danger btn-sm remove_rekom_btn" title="Hapus"><i class="fa-solid fa-minus"></i></button>';
        html += '</td>';
        html += '</tr>';

        tbody.append(html);
        index++;
        renumberTable(tbody);
    });

    // Legacy support for main add button
    $('#add_btn').on('click', function () {
        $(this).closest('.card-header').find('.add_rekom_btn').first().click();
    });




    // Remove recommendation row
    $(document).on('click', '.remove_rekom_btn, #remove', function () {
        var tbody = $(this).closest('tbody');
        var rowToRemove = $(this).closest('tr');
        var parentLevel = rowToRemove.data('level') || 0;

        if (tbody.find('tr[data-level="0"]').length <= 1 && parentLevel === 0) {
            alert('Minimal harus ada satu rekomendasi utama!');
            return;
        }

        // Remove the row and all its nested sub-rows
        var nextRow = rowToRemove.next();
        rowToRemove.remove();

        // Remove all nested sub-rows that belong to this row
        while (nextRow.length > 0 && nextRow.data('level') > parentLevel) {
            var currentRow = nextRow;
            nextRow = nextRow.next();
            currentRow.remove();
        }

        // Renumber all rows in the table
        renumberTable(tbody);
    });

    // Legacy support for add_btn2 (sub-sub recommendation)
    $(document).on('click', '#add_btn2', function () {
        index2++;
        var html = '';
        var level1 = $(this).data('level1');
        var level2 = $(this).data('level2');

        html += '<tr class="sub-level-2" data-level="2" data-rekom-index="' + index2 + '" data-parent="' + level1 + '_' + level2 + '">';
        html += '<td class="nomor-cell"></td>';
        html += '<td><div class="rekomendasi-text"><textarea class="form-control kolom2" name="tipeA[' + level1 + '][sub][' + level2 + '][sub][' + index2 + '][rekomendasi]" required placeholder="Sub-sub rekomendasi..."></textarea></div></td>';
        html += '<td><textarea class="form-control kolom2" name="tipeA[' + level1 + '][sub][' + level2 + '][sub][' + index2 + '][keterangan]" placeholder="Keterangan..."></textarea></td>';
        html += '<td><input type="text" class="form-control kolom2 tanparupiah" name="tipeA[' + level1 + '][sub][' + level2 + '][sub][' + index2 + '][pengembalian]" placeholder="Rp. 0"></td>';
        html += '<td><button type="button" class="btn btn-danger btn-sm remove_rekom_btn" title="Hapus"><i class="fa-solid fa-minus"></i></button></td>';
        html += '</tr>';

        $(this).closest('tr').after(html);
        renumberTable($(this).closest('tbody'));
    });

    // Form validation before submit
    $('form').on('submit', function(e) {
        var hasError = false;
        var errorMessages = [];

        // Check if at least one recommendation exists
        var rekomExists = false;
        $(this).find('textarea[name*="[rekomendasi]"]').each(function() {
            if ($(this).val().trim() !== '') {
                rekomExists = true;
                return false; // Break loop
            }
        });

        if (!rekomExists) {
            hasError = true;
            errorMessages.push('Minimal harus ada satu rekomendasi yang diisi!');
        }

        if (hasError) {
            e.preventDefault();
            alert(errorMessages.join('\n'));
            return false;
        }
    });

    // Initialize numbering on page load
    renumberTable($('tbody.body'));
});
</script>





</script>



@endsection
