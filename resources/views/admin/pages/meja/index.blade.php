@extends('admin.layouts.main')


@section('container')
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-sm-12 mb-xl-0">
            <div class="d-flex bd-highlight ">
                <div class="me-auto p-2 bd-highlight">
                    <h5 class="text-dark font-weight-bold p-0 m-0">Qrcode </h5>
                    <p class="text-muted"> Last login was 23 hours ago. </p>
                </div>
                <div class="p-2 bd-highlight">
                    <a href="/admin/setting/meja/create" class="btn btn-primary">Tambah Qrcode</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-3">
        @foreach ($qrcode as $qr)
            <div class="card m-2" style="width:330px;">
                <div class="row g-0">
                    <div class="col-4 px-0 py-2">
                        {!! QrCode::size(100)->generate($qr->qrcode) !!}
                    </div>
                    <div class="col-8 p-2  ">
                        <h5 class="card-title m-0">{{ $qr->nama }}</h5>
                        <p class="m-0">Created : </p>
                        <span class="text-muted">{{ $qr->created_at }}</span>
                        <a href="/admin/setting/meja/{{ $qr->id }}" class="btn badge btn-info m-0">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
