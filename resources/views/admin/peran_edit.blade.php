@extends('template')
@section('content')
<div class="alert alert-info" role="alert">
    Edit Data Peran
  </div>
<div class="card mb-4">
    <div class="card-header"></div>
    <div class="card-body">
      <form action="{{ url('peran/'.$data['id']) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-6 mb-3">
                    <label for="">Nama Peran </label>
                    <input type="text" name="nama_peran" class="form-control" value="{{ $data['nama_peran'] }}">
                </div>
                <div class="col-6 mb-3">
                    <label for="">Tarif Peran </label>
                    <input type="text" name="tarif" class="form-control" value="{{ $data['tarif'] }}">
                </div>
                <div class="col-6 mb-3">
                    <label for="">Urutan Peran </label>
                    <input type="text" name="sort_order" class="form-control" value="{{ $data['sort_order'] }}" readonly>
                </div>
            </div>

            <button class="btn btn-primary">Edit Peran</button>
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

