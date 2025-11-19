@extends('template')
@section('content')
<div class="alert alert-info" role="alert">
    Edit Data Jenis Pengawasan
  </div>
<div class="card mb-4">
    <div class="card-header"></div>
    <div class="card-body">
       <form action="{{ url('jenisPengawasan/'.$data['id']) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="">Jenis Kegiatan  </label>
                    <textarea name="nama_jenispengawasan" id="" class="form-control">{{ $data['nama_jenispengawasan'] }}</textarea>
                </div>
            </div>

            <button class="btn btn-primary">Edit Jenis Pengawasan</button>
        </form>
    </div>
</div>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script>
            $(document).ready(function () {
                $("#pangkat").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
                $("#kendaraan").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
                $("#jabatan").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
                 $("#status").select2({
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
@endsection

