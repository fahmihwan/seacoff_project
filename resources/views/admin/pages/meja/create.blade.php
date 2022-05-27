@extends('admin.layouts.main')


@section('container')
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex bd-highlight  ">
                <div class="me-auto  bd-highlight">
                    <h3 class="text-dark font-weight-bold mb-2">setting Qrcode </h3>
                    <h6 class="font-weight-normal mb-2">Last login was 23 hours ago. View details</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-3">
        <div class="card m-2" style="width:330px;">
            <div class="row g-0">
                <div class="col-4 px-0 py-2">
                    {!! QrCode::size(100)->generate(Request::url()) !!}
                </div>
                <div class="col-8 p-2 ">
                    <h5 class="card-title m-0">Meja 1</h5>
                    <p class="py-2">Created : 2020-10-11</p>
                    <button class="btn badge btn-info"><i class="fa-solid fa-print"></i></button>
                    <button class="btn badge btn-danger"><i class="fa-solid fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection
