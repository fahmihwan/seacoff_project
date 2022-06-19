@extends('admin.layouts.main')

@section('styles')
    <style>
        .list-order {
            height: 380px;
            overflow: scroll;
        }

        .form-check-input {
            width: 30px;
            height: 30px;
        }
    </style>
@endsection

@section('container')
    <div class="row">
        <div class="col-sm-6 mb-4 mb-xl-0">
            <div class="d-lg-flex align-items-center">
                <div>
                    <h3 class="text-dark font-weight-bold mb-2">Dashboard </h3>
                    <!-- <h6 class="font-weight-normal mb-2">Last login was 23 hours ago. View details</h6> -->
                </div>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-2">
            <div class="row flex-column ">
                <div class="col-md-12 d-flex grid-margin stretch-card mb-3" style="height: 140px">
                    <div class="card" style="width:100%; border-bottom: 8px solid #464dee;">
                        <div class="card-body">
                            <h5 class="text-primary mb-2 font-weight-bold" id="jml-order">0</h5>
                            <h4 class="card-title mb-2"> Order</h4>
                            <p class="text-muted">{{ $current_date }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 d-flex grid-margin stretch-card" style="height: 140px">
                    <div class="card " style="width:100%; border-bottom: 8px solid #464dee;">
                        <div class="card-body">
                            <h5 class="text-primary mb-2" id="jml-transaksi">Rp 0</h5>
                            <h4 class="card-title mb-2">Transaksi</h4>
                            <p class="text-muted">{{ $current_date }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10 grid-margin stretch-card ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">List Order</h4>
                    <div class="table-responsive list-order">
                        <table class="table table-hover ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>nota</th>
                                    <th>nama</th>
                                    <th>meja</th>
                                    <th>transaksi</th>
                                    <th>waktu</th>
                                    <th>order</th>
                                    <th>Status pembayaran</th>
                                    <th>selesai</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                <!-- ajax -->
                                <tr class="border-light">
                                    <td>&nbsp;</td>
                                </tr>
                                <tr class="border-light">
                                    <td>&nbsp;</td>
                                </tr>
                                <tr class="border-light">
                                    <td>&nbsp;</td>
                                </tr>
                                <tr class="border-light">
                                    <td colspan="7" rowspan="4">
                                        <div class="d-flex justify-content-center  " style="line-height:30px; ">
                                            <p class="me-2 text-muted">tunggu sebenta ...</p>
                                            <div class="spinner-border" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modal-meja" aria-hidden="true">
            <div class="modal-dialog" style="width:350px; margin:40px auto;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-meja"> meja</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex bd-highlight mb-3">
                            <div class="me-auto bd-highlight"><b>pesanan</b></div>
                            <div class="bd-highlight"><b>kategori</b></div>
                        </div>
                        <div id="list-order-modal">
                            <!-- ajax -->

                        </div>
                    </div>
                    <div class="modal-body text-center" id="btn-current-status-order">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">nanti dulu</button>
                        <button value="" type="button" class="btn btn-primary" id="buat_pesanan">buat pesanan
                            sekarang</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tBody = document.getElementById('table-body');

            const btnModal = document.getElementsByClassName('getModal')
            const idOrderModal = document.getElementById('list-order-modal');

            const mejaModal = document.getElementById('modal-meja');
            const buat_pesanan = document.getElementById('buat_pesanan');
            const checkBoxSelesai = document.getElementsByClassName('form-check-input');
            const hideButtonModal = document.getElementById('btn-current-status-order');
            const jmlOrder = document.getElementById('jml-order');
            const jmlTransaksi = document.getElementById('jml-transaksi');


            buat_pesanan.addEventListener('click', function(e) {
                hideButtonModal.style.display = "none";
                handleStatusOrder(e.target.value, 'waiting')
            })


            setInterval(loadData, 1000)

            function loadData() {

                let values = ""
                fetch('/json/list-order')
                    .then(response => response.json())
                    .then(res => {
                        handleResultAjax(res, values)
                    }).then(() => {
                        for (let i = 0; i <= btnModal.length - 1; i++) {
                            btnModal[i].addEventListener('click', function() {
                                let id = btnModal[i].value
                                detailModal(id);
                            })
                            checkBoxSelesai[i].addEventListener('click', function(e) {
                                if (e.target.checked) {
                                    handleStatusOrder(e.target.value, 'finish')
                                } else {
                                    handleStatusOrder(e.target.value, 'waiting')
                                }
                            })

                        }
                    })
                    .catch(err => console.log(err));
            }

            function handleResultAjax(res, values) {
                if (res.listOrder.length == 0) {
                    values = ` <tr class="border-light"">
                                    <td colspan="7" rowspan="4">
                                        <div class="d-flex justify-content-center  " style="line-height:30px; ">
                                            <p class="mt-5 me-2 text-muted">belum ada transaksi</p>
                                        </div>
                                    </td>
                                </tr>`
                }
                let iteration = 1;
                let status_payment = '';
                res.listOrder.forEach(e => {
                    if (e.status_pembayaran == 'capture' || e.status_pembayaran == 'settlement') {
                        status_payment = 'text-success'
                    }
                    if (e.status_pembayaran == 'pending' || e.status_pembayaran == 'authorize') {
                        status_payment = 'text-warning'
                    }
                    if (e.status_pembayaran == 'deny' || e.status_pembayaran == 'cancel' || e
                        .status_pembayaran == 'expire' || e.status_pembayaran == 'refund' || e
                        .status_pembayaran == 'partial_refund') {
                        status_payment == 'text-danger'
                    }


                    values += `
                            <tr>
                                <td> ${iteration++}</td>
                                <td> ${e.nota}</td>
                                <td>${e.nama}</td>
                                <td>${e.meja_id}</td>
                                <td>${e.tipe_pembayaran}</td>
                                <td>${e.timeForHumans}</td>
                                <td class="text-danger">
                                    <button type="button" class="btn btn-primary badge text-light getModal" data-bs-toggle="modal" data-bs-target="#modalDetail" value="${e.id}">
                                        detail <span class="badge bg-warning"> ${e.qty}
                                        </span>
                                    </button>
                                </td>
                                <td>
                                    <label class="badge  ${status_payment} ">${e.status_pembayaran}</label>
                                </td>
                                <td>

                                <input class="form-check-input ${e.status_pemesanan == 'order'? '' :'border-primary'}" type="checkbox" value="${e.id}" ${e.status_pemesanan == 'order'? 'disabled' :'' } ${e.status_pemesanan == 'finish'? 'checked' :''}>

                                </td>
                            </tr>`;
                })
                tBody.innerHTML = values;
                jmlOrder.innerText = res.jml_order
                jmlTransaksi.innerText = res.jml_transaksi
            }

            function handleStatusOrder(id, action) {
                fetch('/json/update-order', {
                        method: "POST",
                        body: JSON.stringify({
                            id: id,
                            status: action
                        }),
                        headers: {
                            "Content-type": "application/json; charset=UTF-8"
                        }
                    })
                    .then(response => response.json())
                    .then(res => console.log(res))
                    .catch(err => console.log(err))
            }


            function detailModal(id) {
                let values = ""
                fetch('/json/show-item/' + id)
                    .then(response => response.json())
                    .then(res => {
                        mejaModal.innerText = 'meja nomor ' + res[0].meja_id;
                        res.forEach(e => {
                            values += `<div class="d-flex bd-highlight ">
                                <div class="me-auto  bd-highlight" id="modal-menu"><span id="modal-qty">${e.qty}</span>x
                                    ${e.nama}
                                    </div>
                                    <div class="bd-highlight" id="modal-kategori">${e.kategori}</div>
                                </div>
                                <hr class="mt-0">`
                            handleBtnStatusPembayaran(e.status_pemesanan)
                        });
                        buat_pesanan.value = res[0].id;
                        idOrderModal.innerHTML = values;

                    })
                    .catch(err => console.log(err))
            }

            function handleBtnStatusPembayaran(status_pemesanan) {
                if (status_pemesanan !== 'order') {
                    hideButtonModal.style.display = "none";
                } else {
                    hideButtonModal.style.display = "block";
                }
            }

        })
    </script>
@endsection
