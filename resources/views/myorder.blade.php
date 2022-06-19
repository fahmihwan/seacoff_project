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

    table tr td.name {
        width: 160px;
    }
</style>
@endsection

@section('container')
<div class="container">
    <div class="row" style="background-color: white">
        <div class="col-md-12 d-flex justify-content-between ">
            <div class="top-bar py-2">My Order</div>
            @if ($status == 1)
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
            @endif
        </div>
    </div>


    <div class="row mt-2">
        <div class="col-md-12">
            <div class="nav nav-pills mb-4" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a style="width: 48%" class="me-2 active  btn btn-outline-warning rounded-pill" id="status-pemesanan" data-bs-toggle="pill" href="#tabs-status" aria-controls="tabs-status" aria-selected="true">
                    Status Pemesanan</a>
                <a style="width: 48%" class=" btn btn-outline-warning rounded-pill" id="daftar-pemesanan" data-bs-toggle="pill" href="#d-p-tabs" aria-controls="d-p-tabs" aria-selected="false">Daftar
                    pemesanan</a>
            </div>

            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active " id="tabs-status" role="tabpanel" aria-labelledby="status-pemesanan">

                    <div class="card p-2 ">
                        <p>Nota</p>
                        <table>
                            <tr>
                                <td class="name">nomor nota </td>
                                <td>: <span id="nota-nota">SC05-2022000216E</span></td>
                            </tr>
                            <tr>
                                <td class="name">nama pemesan </td>
                                <td>: <span id="nota-nama">Fahmi</span> </td>
                            </tr>
                            <tr>
                                <td class="name">meja </td>
                                <td id="meja">: <span id="nota-meja">1</span></td>
                            </tr>
                            <tr>
                                <td class="name">status pemesanan </td>
                                <td>: <span class="text-success"> <i class="fas fa-check-circle"></i></span> <span id="nota-status-pemesanan">Order</span></td>
                            </tr>
                            <tr>
                                <td class="name">status pembayaran </td>
                                <td>: <span class="text-success"> <i class="fas fa-check-circle"></i></span>
                                    <span id="nota-status-pembayaran">berhasil</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="name">waktu pemesanan</td>
                                <td>: <span id="nota-waktu"></span> </td>
                            </tr>
                            <tr>
                                <td class="name"> Harga</td>
                                <td>: Rp <span id="nota-harga">18000</span> </td>
                            </tr>
                            <tr>
                                <td class="name">PPN(10%) </td>
                                <td>: Rp <span id="nota-ppn">1800</span> </td>
                            </tr>
                            <tr>
                                <td class="name">Total</td>
                                <td>: Rp <span id="nota-total">19800</span> </td>
                            </tr>
                        </table>
                        <div class="text-center">
                            <button class="btn btn-sm btn-primary mt-3 " style="width: 130px;">export PDF <i class="fas fa-print"></i></button>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="d-p-tabs" role="tabpanel" aria-labelledby="daftar-pemesanan">


                    <div id="list-order-customer">

                    </div>


                </div>

            </div>
        </div>
    </div>


    <div class="col-md-12 {{ $status == 0 && 'd-flex justify-content-center align-items-center' }} ">
        @if (Session::has('token'))
        {{-- <div class="d-flex justify-content-center " style="margin-top:200px; ">
                    <p class="me-2 text-muted">tunggu sebenta ...</p>
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div> --}}
        @endif

        @if ($status == 0)
        <div class="d-flex flex-column justify-content-center align-items-center " style="height: 80vh">
            <img src="{{ asset('assets/images/QR Code-pana.png') }}" alt="" style="width: 70%;">
            <br>
            <p class="text-muted">{{ $data }}</p>
        </div>
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
            realtimeNotif()
        }, 1000);
        sweatalertt()
    }

    function sweatalertt() {
        const btnPindah = document.getElementById('pindah-meja')
        const formPindah = document.getElementById('form-pidah');
        btnPindah.addEventListener('click', function(e) {
            e.preventDefault()
            Swal.fire({
                title: 'mau pindah meja sekarang?',
                text: "jika anda memiliki pesanan yang belum selesai di buat, anda tidak dapat memindahkan pesanan anda ke meja lain!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Pindah Sekarang!!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    formPindah.submit();
                }
            })
        })

    }

    function realtimeNotif() {
        fetch('/json/my-order/notif')
            .then(response => response.json())
            .then(res => apendOrder(res))
            .catch(err => console.log(err))
    }

    function apendOrder(res) {

        const listOrderCustomer = document.getElementById('list-order-customer');
        let daftarPemesanan = ''
        console.log(res.listOrder)
        if (res.listOrder.length != 0) {
            res.listOrder.forEach(e => {
                daftarPemesanan += `<div class="card mb-2">
                            <div class="clear-fix">
                                <div class="float-start">
                                    <img src="/storage/${e.gambar}"
                                        alt="" style="width: 140px">
                                </div>
                                <div class="float-end pt-2 " style="width: 65%">
                                    <p class="m-0"> ${e.nama} <span class="text-muted">( ${e.kategori} )</span></p>
                                    <p class="m-0">Rp. ${e.harga}</p>
                                    <p class="m-0">qty: <span class="text-muted"> ${e.qty}</span></p>
                                </div>
                            </div>
                        </div>`
                listOrderCustomer.innerHTML = daftarPemesanan
                handleNotaAjax(e.nota, e.timeForHumans, e.nama_pemesan, e.status_pemesanan, e.status_pembayaran, e.total_bayar, res.totalQty)
            })
        }
    }

    function handleNotaAjax(...nota) {
        document.getElementById('nota-nota').innerText = nota[0]
        document.getElementById('nota-meja')
        document.getElementById('nota-nama').innerText = nota[2]
        document.getElementById('nota-status-pemesanan').innerText = nota[3]
        document.getElementById('nota-status-pembayaran').innerText = nota[4]
        document.getElementById('nota-waktu').innerText = nota[1]
        document.getElementById('nota-harga')
        document.getElementById('nota-ppn')
        document.getElementById('nota-total').innerText = nota[5]
    }
</script>
@endsection