@extends('template')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <link href='chosen/chosen.min.css' rel='stylesheet' type='text/css'>
  <script src='chosen/chosen.jquery.min.js' type='text/javascript'></script>
    <div class="alert alert-info" role="alert">
        Tambah Data Dinas Luar
    </div>
    <div class="card mb-4">
        <div class="card-header"></div>
        <div class="card-body">
            <form action="{{ url('/tabelkendali_baru') }}" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="row">
                    <div class="col-4 mb-3">
                        <label for="">Pegawai </label>
                    <select id="jabatan" class="form-control" name="id_pegawai">
                    <option value="" disabled selected>Select your option</option>
                         @foreach ($tabelkendali as $key => $pg)
                           <option value="{{ $pg['id'] }}">{{ $pg['nama_pegawai'] }}</option>
                        @endforeach
                </select>
                    </div>
                    <div class="col-4 mb-3">
                        <label for="">Tanggal Awal Dinas Luar </label>
                        <input type="text" name="tanggal_awal_pemeriksaan" class="form-control datepicker " value="{{ old('tanggal_awal_pemeriksaan') }}" >
                    </div>
                    <div class="col-4 mb-3">
                        <label for="">Tanggal Akhir  Dinas Luar </label>
                        <input type="text" name="tanggal_akhir_pemeriksaan" class="form-control datepicker " value="{{ old('tanggal_akhir_pemeriksaan') }}" >
                    </div>

                </div>
                <div class="row">
                </div>

                <button class="btn btn-primary">Tambah Kegiatan</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $("#pptk").select2({
                theme: 'bootstrap4',
                placeholder: "Please Select"
            });
            $("#jabatan").select2({
                theme: 'bootstrap4',
                placeholder: "Please Select"
            });
            $("#eselon").select2({
                theme: 'bootstrap4',
                placeholder: "Please Select"
            });
            $("#tahun").select2({
                theme: 'bootstrap4'
            });
        });
    </script>

    <script>
        @if (session('warning'))
            $(document).ready(function() {
                $("#myModal").modal('show');
            });
        @endif
    </script>

    <script>
    $(document).ready(function () {
        $("#jp").select2({
            placeholder: "Please Select",
            allowClear:true,
        });

        $("#obrik").select2({
            placeholder: "Please Select",
            allowClear:true,
        });


         $("#kegiatan").select2({
            placeholder: "Please Select",
            allowClear:true,
        });

         $(".namaPeran").select2({
            placeholder: "Please Select",
            allowClear:true,
        });

         $(".namaAnggota").select2({
            placeholder: "Please Select",
            allowClear:true,
        });
          $("#tahun").select2({
            theme: 'bootstrap4'
        });

    });
</script>

  <script>



    $( function() {
        $( ".datepicker" ).datepicker({
            dateFormat: "yy-mm-dd",
            beforeShowDay:$.datepicker.noWeekends,
            changeYear:true,
            changeMonth:true,
            //  dateFormat: "dd-mm-yy"
        });

    } );





</script>
@endsection
