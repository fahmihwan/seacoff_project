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
    <div class="col-4 d-flex ">
        <div class="col-lg-6 d-flex grid-margin stretch-card me-3" style="height: 140px">
            <div class="card sale-diffrence-border">
                <div class="card-body">
                    <h3 class="text-dark mb-2 font-weight-bold">175</h3>
                    <h4 class="card-title mb-2"> Order</h4>
                    <small class="text-muted">APRIL 2019</small>
                </div>
            </div>
        </div>
        <div class="col-lg-6 d-flex grid-margin stretch-card" style="height: 140px">
            <div class="card sale-visit-statistics-border">
                <div class="card-body">
                    <h3 class="text-dark mb-2 font-weight-bold">Rp8000</h3>
                    <h4 class="card-title mb-2">Transaksi</h4>
                    <small class="text-muted">APRIL 2019</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 grid-margin stretch-card ">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">List Order</h4>
                <div class="table-responsive list-order">
                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Meja</th>
                                <th>transaksi</th>
                                <th>waktu</th>
                                <th>order</th>
                                <th>Status pembayaran</th>
                                <th>selesai</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <!-- ajax -->
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
                    <button value="" type="button" class="btn btn-primary" id="buat_pesanan">buat pesanan sekarang</button>
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



        buat_pesanan.addEventListener('click', function(e) {
            hideButtonModal.style.display = "none";
            handleStatusOrder(e.target.value, 'in process')
        })

        setInterval(loadData, 2000)

        function loadData() {
            let values = ""
            fetch('/json/list-order')
                .then(response => response.json())
                .then(res => {
                    let iteration = 1;
                    res.forEach(e => {
                        values += `
                            <tr>
                                <td> ${iteration++}</td>
                                <td>${e.meja_id}</td>
                                <td>${e.tipe_pembayaran}</td>
                                <td>${e.created_at}</td>
                                <td class="text-danger">
                                    <button type="button" class="btn btn-primary badge text-light getModal" data-bs-toggle="modal" data-bs-target="#modalDetail" value="${e.id}">
                                        detail <span class="badge bg-warning"> 4
                                        </span>
                                    </button>
                                </td>
                                <td>
                                    <label class="badge ${e.status_pembayaran != 'pending'? 'badge-success' : 'badge-danger'}  ">${e.status_pembayaran}</label>
                                </td>
                                <td>

                                <input class="form-check-input ${e.status_pemesanan == 'order'? '' :'border-primary'}" type="checkbox" value="${e.id}" ${e.status_pemesanan == 'order'? 'disabled' :'' } ${e.status_pemesanan == 'finish'? 'checked' :''}>

                                </td>
                            </tr>`;
                    })
                    tBody.innerHTML = values;
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
                                handleStatusOrder(e.target.value, 'in process')
                            }
                        })

                    }
                })
                .catch(err => console.log(err));
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