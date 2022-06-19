{{-- @dd($data) --}}
@extends('layout.landingPage')
@section('styles')
    <style>
        body {
            background-color: rgb(246, 246, 246)
        }

        .btn-group ul li a.scanQr {
            color: white;
            border: 8px solid rgb(246, 246, 246);
            /* background-color: rgb(157, 135, 135); */
            background-color: rgb(233, 132, 8);
            height: 80px;
            width: 80px;
            border-radius: 80px;
            display: block;
            font-size: 30px;
            transform: translateY(-40px);
            line-height: 60px;
        }
    </style>
@endsection

@section('container')
    <div class="container">
        <div class="row" style="background-color: white">
            <div class="col-md-12 d-flex justify-content-between ">
                <div class="top-bar py-2">My Order</div>
                {{-- @if ($status == 1)
                    <div class="top-bar py-2">
                        <b>{{ $data->nama }}</b>
                    </div>
                    <div class="top-bar py-2">
                        <form action="/home/pindah-meja" method="post" id="form-pidah">
                            @csrf
                            <input type="hidden" value="{{ $data->qrcode }}" name="qrcode">
                            <button type="submit" class="btn btn-warning btn-sm" id="pindah-meja">Pindah Meja</button>
                        </form>
                    </div>
                @endif --}}
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <a href="/home/my-order/" type="button" class="btn btn-sm btn-outline-secondary rounded-pill">status
                    pemesanan</a>
                <a href="/home/my-order/list-order" type="button" class="btn btn-sm btn-outline-danger rounded-pill">daftar
                    pesanan</a>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12  " id="list-order-customer">
                <div class="card mb-2">
                    <div class="card-header bg-white clearfix">
                        <span class="float-start">status pemesanan: order</span>
                    </div>
                    <div class="clear-fix">
                        <div class="float-start">
                            <img src="/storage/foto-deluna/6rVVosXfR7NXaaNI6dxNLjvrN0pQRva2ECzK0te9.jpg" alt=""
                                style="width: 140px">
                        </div>
                        <div class="float-end " style="width: 59%">
                            <p class="m-0"> americano <span class="text-muted">( ice )</span></p>
                            <p class="m-0">Rp. 20.000</p>
                            <p class="m-0">order: <span class="text-muted"> 1 menit yang lalu</span></p>
                            <p class="m-0">qty: <span class="text-muted"> 3</span></p>
                            <p class="m-0">status pembayaran: <span class="text-muted"> berhasil</span></p>
                        </div>
                    </div>
                </div>
                @if (Session::has('token'))
                    {{-- <div class="d-flex justify-content-center " style="margin-top:200px; ">
                        <p class="me-2 text-muted">tunggu sebenta ...</p>
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div> --}}
                @endif


            </div>

        </div>
    </div>
    <input type="text" value="{{ Session::has('token') ? 1 : 0 }}" id="cek-session" hidden>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const cekSession = document.getElementById('cek-session');
        if (cekSession.value != 0) {
            setInterval(() => {
                // realtimeNotif()
            }, 1000);
            sweatalertt()
        }

        // function sweatalertt() {
        //     const btnPindah = document.getElementById('pindah-meja')
        //     const formPindah = document.getElementById('form-pidah');
        //     btnPindah.addEventListener('click', function(e) {
        //         e.preventDefault()
        //         Swal.fire({
        //             title: 'mau pindah meja sekarang?',
        //             text: "jika anda memiliki pesanan yang belum selesai di buat, anda tidak dapat memindahkan pesanan anda ke meja lain!",
        //             icon: 'warning',
        //             showCancelButton: true,
        //             confirmButtonColor: '#3085d6',
        //             cancelButtonColor: '#d33',
        //             confirmButtonText: 'Pindah Sekarang!!'
        //         }).then((result) => {
        //             if (result.isConfirmed) {
        //                 Swal.fire(
        //                     'Deleted!',
        //                     'Your file has been deleted.',
        //                     'success'
        //                 )
        //                 formPindah.submit();

        //             }
        //         })
        //     })

        // }

        // function realtimeNotif() {
        //     fetch('/json/my-order/notif')
        //         .then(response => response.json())
        //         .then(res => apendOrder(res))
        //         .catch(err => console.log(err))
        // }

        // function apendOrder(res) {
        //     const listOrderCustomer = document.getElementById('list-order-customer');
        //     let text = ''
        //     if (res.listOrder.length != 0) {
        //         res.listOrder.forEach(e => {
        //             text += `
    //         <div class="card mb-2">
    //                     <div class="clear-fix">
    //                         <div class="float-start">
    //                             <img src="/storage/${e.gambar}" alt="" style="width: 140px">
    //                         </div>
    //                         <div class="float-end " style="width: 59%">
    //                             <p class="m-0"> ${e.nama} <span class="text-muted">(
    //                                     ${e.kategori} )</span></p>
    //                             <p class="m-0">Rp. ${e.harga}</p>
    //                             <p>order: <span
    //                                     class="text-muted"> ${e.created_at}</span></p>
    //                             <div class="float-end text-end p-2 position-absolute bottom-0 start-0 "
    //                                 style="width: 100%;">
    //                                 <span class="p-2 text-muted me-2"> qty : ${e.qty}</span>
    //                                 <span class="p-2">

    //                                     <span class="text-success"><i class="fas fa-check-circle"></i></span>
    //                                     ${e.status_pemesanan}
    //                                 </span>
    //                             </div>
    //                         </div>
    //                     </div>
    //                 </div> `
        //             listOrderCustomer.innerHTML = text;
        //         });
        //     } else {
        //         listOrderCustomer.innerHTML = `
    //     <p class="text-center" style="margin-top:200px; "> Anda belum memiliki pesanan </p>
    //     `
        //     }

        // }
    </script>
@endsection
