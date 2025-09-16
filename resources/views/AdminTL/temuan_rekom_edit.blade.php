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
     table #baris1 .kolom1{
        margin-left: 10px;
    }
    table #baris .kolom{
        margin-left: 20px;
    }
    table #baris2 .kolom2{
        margin-left: 30px;
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

<div class="card mb-4" style="width: 100%;">
<div class="card-header"> Jenis Temuan dan Rekomendasi</div>
<div class="d-flex justify-content-end" style="background-color:bisque"><button type="button" class="btn btn-primary btn-sm" id="add_card"><i class="fa-solid fa-plus"></i></button></div>
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
        
        <form action="{{ url('adminTL/temuan/') }}" method="post" enctype="multipart/form-data">
           @method('POST')
           @csrf
           <input type="hidden" name="id_pengawasan" value="{{ $pengawasan['id'] }}">
           <input type="hidden" name="id_penugasan" value="{{ $pengawasan['id_penugasan'] }}">
    <table class="table">
               <thead>
                   <tr>
                       <th scope="col">KODE TEMUAN <span class="text-danger">*</span></th>
                       <th scope="col">NAMA TEMUAN <span class="text-danger">*</span></th>
                   </tr>
               </thead>
               <tbody>
                   <tr>
                    <td><input type="text" name="temuan[0][kode_temuan]" class="form-control" required></td>
                    <td><input type="text" name="temuan[0][nama_temuan]" class="form-control" required></td>
                   </tr>
               </tbody>
           </table>
           <table class="table">
            <thead>
              <tr>
                <th scope="col">Nomor</th>
                <th scope="col">NAMA REKOMENDASI <span class="text-danger">*</span></th>
                <th scope="col">KETERANGAN REKOMENDASI</th>
                <th scope="col">PENGEMBALIAN KEUANGAN</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody class="body" id="parenttemuan_0">
              <tr class="sub0" data-temuan-index="0" data-rekom-index="0">
                <td>1</td>
                <td><textarea class="form-control" name="temuan[0][rekomendasi][0][rekomendasi]" required></textarea></td>
                <td><textarea class="form-control" name="temuan[0][rekomendasi][0][keterangan]"></textarea></td>
                <td><input type="text" class="form-control tanparupiah" name="temuan[0][rekomendasi][0][pengembalian]" placeholder="Rp. 0"></td>
                <td>
                    <button type="button" data-temuan-index="0" class="btn btn-success btn-sm add_rekom_btn"><i class="fa-solid fa-plus"></i></button>
                    <button type="button" class="btn btn-danger btn-sm remove_rekom_btn"><i class="fa-solid fa-minus"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div id="temuanBaru" class="mt-2"></div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('adminTL/temuanrekom') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<script>
// Global variables
let temuanCounter = 1; // Start from 1 since we already have temuan[0]
let rekomCounter = {}; // Track recommendation counter for each temuan

// Initialize recommendation counter for existing temuan
rekomCounter[0] = 1; // temuan[0] already has rekomendasi[0]

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

$(document).ready(function() {

    // Format rupiah on input
    $(document).on('keyup', '.tanparupiah', function (e) {
        let rupiah = formatRupiah($(this).val());
        $(this).val(rupiah);
    });

    // Add new recommendation row
    $(document).on('click', '.add_rekom_btn', function () {
        var temuanIndex = $(this).data('temuan-index');

        // Initialize counter if not exists
        if (!rekomCounter[temuanIndex]) {
            rekomCounter[temuanIndex] = 0;
        }

        rekomCounter[temuanIndex]++;
        var rekomIndex = rekomCounter[temuanIndex];
        var rowNumber = $(this).closest('tbody').find('tr').length + 1;

        var html = '';
        html += '<tr class="sub' + temuanIndex + '" data-temuan-index="' + temuanIndex + '" data-rekom-index="' + rekomIndex + '">';
        html += '<td>' + rowNumber + '</td>';
        html += '<td><textarea class="form-control" name="temuan[' + temuanIndex + '][rekomendasi][' + rekomIndex + '][rekomendasi]" required></textarea></td>';
        html += '<td><textarea class="form-control" name="temuan[' + temuanIndex + '][rekomendasi][' + rekomIndex + '][keterangan]"></textarea></td>';
        html += '<td><input type="text" class="form-control tanparupiah" name="temuan[' + temuanIndex + '][rekomendasi][' + rekomIndex + '][pengembalian]" placeholder="Rp. 0"></td>';
        html += '<td>';
        html += '<button type="button" data-temuan-index="' + temuanIndex + '" class="btn btn-success btn-sm add_rekom_btn"><i class="fa-solid fa-plus"></i></button> ';
        html += '<button type="button" class="btn btn-danger btn-sm remove_rekom_btn"><i class="fa-solid fa-minus"></i></button>';
        html += '</td>';
        html += '</tr>';

        $(this).closest('tbody').append(html);
    });

    // Remove recommendation row
    $(document).on('click', '.remove_rekom_btn', function () {
        var tbody = $(this).closest('tbody');
        $(this).closest('tr').remove();

        // Renumber rows
        tbody.find('tr').each(function(index) {
            $(this).find('td:first').text(index + 1);
        });
    });

    // Add new temuan card
    $('#add_card').on('click', function () {
        var temuanIndex = temuanCounter;
        rekomCounter[temuanIndex] = 0; // Initialize recommendation counter for new temuan

        var cardHtml = '';
        cardHtml += '<div class="card mb-3 temuan-card" data-temuan-index="' + temuanIndex + '">';
        cardHtml += '<div class="card-header d-flex justify-content-between align-items-center">';
        cardHtml += 'Tambah Jenis Temuan ' + (temuanIndex + 1);
        cardHtml += '<button type="button" class="btn btn-danger btn-sm hapus_card"><i class="fa-solid fa-trash"></i></button>';
        cardHtml += '</div>';
        cardHtml += '<div class="card-body">';

        // Temuan table
        cardHtml += '<table class="table">';
        cardHtml += '<thead>';
        cardHtml += '<tr>';
        cardHtml += '<th scope="col">KODE TEMUAN <span class="text-danger">*</span></th>';
        cardHtml += '<th scope="col">NAMA TEMUAN <span class="text-danger">*</span></th>';
        cardHtml += '</tr>';
        cardHtml += '</thead>';
        cardHtml += '<tbody>';
        cardHtml += '<tr>';
        cardHtml += '<td><input type="text" name="temuan[' + temuanIndex + '][kode_temuan]" class="form-control" required></td>';
        cardHtml += '<td><input type="text" name="temuan[' + temuanIndex + '][nama_temuan]" class="form-control" required></td>';
        cardHtml += '</tr>';
        cardHtml += '</tbody>';
        cardHtml += '</table>';
        
        // Recommendation table
        cardHtml += '<table class="table">';
        cardHtml += '<thead>';
        cardHtml += '<tr>';
        cardHtml += '<th scope="col">Nomor</th>';
        cardHtml += '<th scope="col">NAMA REKOMENDASI <span class="text-danger">*</span></th>';
        cardHtml += '<th scope="col">KETERANGAN REKOMENDASI</th>';
        cardHtml += '<th scope="col">PENGEMBALIAN KEUANGAN</th>';
        cardHtml += '<th>Aksi</th>';
        cardHtml += '</tr>';
        cardHtml += '</thead>';
        cardHtml += '<tbody class="body" id="parenttemuan_' + temuanIndex + '">';
        cardHtml += '<tr class="sub' + temuanIndex + '" data-temuan-index="' + temuanIndex + '" data-rekom-index="0">';
        cardHtml += '<td>1</td>';
        cardHtml += '<td><textarea class="form-control" name="temuan[' + temuanIndex + '][rekomendasi][0][rekomendasi]" required></textarea></td>';
        cardHtml += '<td><textarea class="form-control" name="temuan[' + temuanIndex + '][rekomendasi][0][keterangan]"></textarea></td>';
        cardHtml += '<td><input type="text" class="form-control tanparupiah" name="temuan[' + temuanIndex + '][rekomendasi][0][pengembalian]" placeholder="Rp. 0"></td>';
        cardHtml += '<td>';
        cardHtml += '<button type="button" data-temuan-index="' + temuanIndex + '" class="btn btn-success btn-sm add_rekom_btn"><i class="fa-solid fa-plus"></i></button> ';
        cardHtml += '<button type="button" class="btn btn-danger btn-sm remove_rekom_btn"><i class="fa-solid fa-minus"></i></button>';
        cardHtml += '</td>';
        cardHtml += '</tr>';
        cardHtml += '</tbody>';
        cardHtml += '</table>';        cardHtml += '</div>';
        cardHtml += '</div>';

        $("#temuanBaru").append(cardHtml);
        temuanCounter++;
    });

    // Remove temuan card
    $(document).on('click', '.hapus_card', function () {
        $(this).closest('.temuan-card').remove();
    });

    // Form validation before submit
    $('form').on('submit', function(e) {
        var hasError = false;
        var errorMessages = [];

        // Check if at least one temuan exists
        var temuanExists = false;
        $('input[name*="nama_temuan"]').each(function() {
            if ($(this).val().trim() !== '') {
                temuanExists = true;
                return false;
            }
        });

        if (!temuanExists) {
            errorMessages.push('Minimal harus ada satu temuan yang diisi');
            hasError = true;
        }

        // Check if each temuan has at least one recommendation
        $('input[name*="nama_temuan"]').each(function() {
            if ($(this).val().trim() !== '') {
                var temuanIndex = $(this).attr('name').match(/temuan\[(\d+)\]/)[1];
                var hasRekom = false;

                $('textarea[name*="temuan[' + temuanIndex + '][rekomendasi]"][name*="[rekomendasi]"]').each(function() {
                    if ($(this).val().trim() !== '') {
                        hasRekom = true;
                        return false;
                    }
                });

                if (!hasRekom) {
                    errorMessages.push('Temuan ' + (parseInt(temuanIndex) + 1) + ' harus memiliki minimal satu rekomendasi');
                    hasError = true;
                }
            }
        });

        if (hasError) {
            e.preventDefault();
            alert('Error:\n' + errorMessages.join('\n'));
        }
    });
});
</script>
@endsection
