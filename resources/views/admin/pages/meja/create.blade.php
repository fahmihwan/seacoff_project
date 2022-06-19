@extends('admin.layouts.main')


@section('container')
    <div class="row">
        <div class="col-sm-12 mb-xl-0">
            <div class="d-flex bd-highlight ">
                <div class="me-auto p-2 bd-highlight">
                    <h5 class="text-dark font-weight-bold p-0 m-0">Qrcode </h5>
                    <p class="text-muted"> Last login was 23 hours ago. </p>
                </div>

            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="card float-start" style="width:500px;">
            <div class="card-body">
                <h4 class="card-title">Buat Qrcode meja</h4>
                {{-- <p class="card-description">
                    Basic form elements
                </p> --}}
                <form action="/admin/setting/meja" class="forms-sample" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="menu">Nama Meja</label>
                        <input type="text" class="form-control" id="menu" name="nama" autocomplete="off"
                            placeholder="Name">
                    </div>

                    <button type="submit" class="btn btn-primary me-2">simpan </button>
                    <a href="/admin/item" class="btn btn-warning ">Kembali</a>
                </form>
            </div>
        </div>

    </div>
@endsection
