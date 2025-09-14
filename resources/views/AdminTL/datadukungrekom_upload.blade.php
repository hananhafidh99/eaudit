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
        margin-left: 15px;
    }
    table #baris2 .kolom2{
        margin-left: 20px;
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
<div class="card-header">Tambah Rekomendasi</div>
<div class="card">
         <form action="{{ url('adminTL/rekom/') }}" method="post" enctype="multipart/form-data">
           @method('POST')
           @csrf
           <input type="hidden" name="id_pengawasan" value="{{ $pengawasan['id'] }}">
           <input type="hidden" name="id_penugasan" value="{{ $pengawasan['id_penugasan'] }}">
           <table class="table" id="tabel1">
            <thead>
              <tr>
                <th scope="col">Nomor</th>
                <th scope="col">NAMA REKOMENDASI</th>
                <th scope="col">KETERANGAN REKOMENDASI</th>
                <th scope="col">PENGEMBALIAN KEUANGAN</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody class="body">
                @if(isset($data) && count($data) > 0)
                @foreach($data as $key => $item)
                <tr class="sub{{ $key }}">
                    <td>{{ $loop->iteration }}</td>
                    <td><textarea class="form-control" name="tipeA[{{ $key }}][rekomendasi]">{{ $item->rekomendasi }}</textarea></td>
                    <td><textarea class="form-control" name="tipeA[{{ $key }}][keterangan]">{{ $item->keterangan }}</textarea></td>
                    <td><input type="text" class="form-control tanparupiah"
                               name="tipeA[{{ $key }}][pengembalian]"
                                value="{{ number_format($item->pengembalian,0,',','.') }}"></td>
                    <td>
                        <button type="button" data-level1="{{ $key }}" data-parentid="{{ $item->id }}" class="btn btn-success" id="add_btnEdit">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        @if($key == 0)
                            <button type="button" class="btn btn-primary" id="add_btn">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        @endif
                        {{-- <button type="button" class="btn btn-danger" id="remove">
                            <i class="fa-solid fa-minus"></i>
                        </button> --}}
                    </td>
                </tr>

                    @if(isset($item->sub))
                        @foreach($item->sub as $subKey => $subItem)
                            <tr id="baris1">
                                <td></td>
                                <td><input type="text" class="form-control kolom1"
                                        name="tipeA[{{ $key }}][sub][{{ $subKey }}][rekomendasi]"
                                        value="{{ $subItem->rekomendasi }}"></td>
                                <td><input type="text" class="form-control kolom1"
                                        name="tipeA[{{ $key }}][sub][{{ $subKey }}][keterangan]"
                                        value="{{ $subItem->keterangan }}"></td>
                                <td><input type="text" class="form-control kolom1 tanparupiah"
                                        name="tipeA[{{ $key }}][sub][{{ $subKey }}][pengembalian]"
                                        value="{{ number_format($subItem->pengembalian,0,',','.') }}"></td>
                                <td>
                                    <button type="button" data-level1="{{ $key }}" data-level2="{{ $subKey }}" data-parentid="{{ $subItem->id }}"
                                            class="btn btn-success" id="add_btnEdit1">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger" id="remove"><i class="fa-solid fa-minus"></i></button>
                                </td>
                            </tr>
                            @if(isset($subItem->sub))
                                @foreach($subItem->sub as $nestedKey => $nestedItem)
                                    <tr id="baris2">
                                        <td></td>
                                        <td><input type="text" class="form-control kolom2"
                                                name="tipeA[{{ $key }}][sub][{{ $subKey }}][sub][{{ $nestedKey }}][rekomendasi]"
                                                value="{{ $nestedItem->rekomendasi }}"></td>
                                        <td><input type="text" class="form-control kolom2"
                                                name="tipeA[{{ $key }}][sub][{{ $subKey }}][sub][{{ $nestedKey }}][keterangan]"
                                                value="{{ $nestedItem->keterangan }}"></td>
                                        <td><input type="text" class="form-control kolom2 tanparupiah"
                                                name="tipeA[{{ $key }}][sub][{{ $subKey }}][sub][{{ $nestedKey }}][pengembalian]"
                                                value="{{ number_format($nestedItem->pengembalian,0,',','.') }}"></td>
                                        <td>
                                            <button type="button" class="btn btn-danger" id="remove"><i class="fa-solid fa-minus"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @else
                <tr class="sub0" >
                    <td>1</td>
                    <td><textarea class="form-control" name="tipeA[0][rekomendasi]"></textarea></td>
                    <td><textarea class="form-control" name="tipeA[0][keterangan]"></textarea></td>
                    <td><textarea class="form-control tanparupiah" name="tipeA[0][pengembalian]"></textarea></td>
                    <td>
                        <button type="button" data-level1="0" class="btn btn-success" id="add_btn1"><i class="fa-solid fa-plus"></i></button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" id="add_btn"><i class="fa-solid fa-plus"></i></button>
                    </td>
                </tr>
                @endif
            </tbody>
          </table>
<button class="btn btn-info">Submit</button>
         </form>
</div>
</div>

<div class="card mt-3" style="width: 100%; ">
    <div class="card-header">Upload Data Dukung</div>
    <div class="card-body">
            <form action="" method="post" name="photo" id="imageuploadform" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
        <input type="file" id="fileUpload" multiple placeholder="choose file or browse" class="form-control"/> <!-- Add 'multiple' attribute for multiple file selection -->
                    </div>
                </div>
        <button onclick="uploadFiles()" class="mt-3 btn btn-info">Upload</button> <!-- Change function name -->
            </form>
        <div>
            <table id="progressBarsContainer">
                <!-- Table rows will be dynamically added here -->
            </table>
        </div> <!-- Container for progress bars -->
        <br>
    </div>
</div>

<div class="card mt-3" style="width: 100%; ">
    <div class="card-header">Berkas Data Dukung</div>
    <div class="card-body">

    </div>
</div>

    <script>
        function uploadFiles() {
            var fileInput = document.getElementById('fileUpload');
            var files = fileInput.files;

            for (var i = 0; i < files.length; i++) {
                var allowedExtensions = ['.jpg', '.jpeg', '.png', '.pdf', '.svg', '.zip', '.docx', '.xlsx'];
                var fileExtension = files[i].name.substring(files[i].name.lastIndexOf('.')).toLowerCase();

                if (allowedExtensions.includes(fileExtension)) {
                    uploadFile(files[i]);
                } else {
                    alert('Invalid file type: ' + fileExtension);
                }
            }
        }

        function uploadFile(file) {
            var formData = new FormData();
            formData.append('file', file);

            var progressBarContainer = document.createElement('div'); // Container for progress bar and file name
            progressBarContainer.className = 'progress-container';

            var fileName = document.createElement('div'); // Display file name
            fileName.className = 'file-name';
            fileName.textContent = file.name;
            //progressBarContainer.appendChild(fileName);

            var progressBar = document.createElement('div'); // Create a new progress bar element
            progressBar.className = 'progress-bar';
            progressBar.id = 'progressBar_' + file.name;

            progressBarContainer.appendChild(progressBar);

            var progressBarsContainer = document.getElementById('progressBarsContainer');

            var newRow = document.createElement('tr'); // Create a new table row
            var newCell = document.createElement('td'); // Create a new table cell
            var newCell2 = document.createElement('td'); // Create a new table cell
            newCell.appendChild(fileName);
            newCell2.appendChild(progressBarContainer);
            newRow.appendChild(newCell);
            newRow.appendChild(newCell2);
            progressBarsContainer.appendChild(newRow);

            var xhr = new XMLHttpRequest();

            xhr.upload.addEventListener('progress', function(event) {
                if (event.lengthComputable) {
                    var percent = Math.round((event.loaded / event.total) * 100);
                    progressBar.style.width = percent + '%';
                    progressBar.innerHTML = percent + '%';
                }
            });

            xhr.addEventListener('load', function(event) {
                var uploadStatus = document.getElementById('uploadStatus');
                uploadStatus.innerHTML = event.target.responseText;
                // Reset the input field of type "file"
                document.getElementById('fileUpload').value = '';

            });

            xhr.open('POST', 'upload.php', true);
            xhr.send(formData);
        }
    </script>






@endsection
