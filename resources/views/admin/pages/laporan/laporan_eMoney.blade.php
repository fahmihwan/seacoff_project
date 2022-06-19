@extends('admin.layouts.main')


@section('container')
    <div class="row">
        <div class="col-sm-12 mb-xl-0">
            <div class="d-flex bd-highlight ">
                <div class="me-auto p-2 bd-highlight">
                    <h5 class="text-dark font-weight-bold p-0 m-0">Laporan pembayaran E-Money</h5>
                    <p class="text-muted"> Last login was 23 hours ago. </p>
                </div>
                {{-- <div class="p-2 bd-highlight">
                    <input type="text" class="form-control" placeholder="cari menu ...  ">
                </div>
                <div class="p-2 bd-highlight">
                    <a href="item/create" class="btn btn-primary">Tambah Menu</a>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div style=" background-color: white; padding: 15px;">
                <table id="example" class="table table-hover display border " style="width:100%">
                    <thead>
                        <tr>
                            <th>no</th>
                            <th>meja</th>
                            <th>id transaksi</th>
                            <th>id pemesanan</th>
                            <th>status pemesanan</th>
                            <th>status pembayaran</th>
                            <th>tipe pembayaran</th>
                            <th>kode pembayaran</th>
                            <th>pdf</th>
                            <th>total bayar</th>
                            <th>tgl transaksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>no</th>
                            <th>meja</th>
                            <th>id transaksi</th>
                            <th>id pemesanan</th>
                            <th>status pemesanan</th>
                            <th>status pembayaran</th>
                            <th>tipe pembayaran</th>
                            <th>kode pembayaran</th>
                            <th>pdf</th>
                            <th>total bayar</th>
                            <th>tgl transaksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card mt-3 p-3">
                <form method="post" action="/admin/laporan/penjualan/print/laporan_eMoney_date">
                    @csrf
                    <div class="mb-3">
                        <label for="date" class="form-label">Export PDF berdasarkan hari penjualan</label>
                        <input type="date" name="date" class="form-control" id="date">
                    </div>
                    <button type="submit" class="btn btn-primary">Export</button>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mt-3 p-3">
                <form method="post" action="/admin/laporan/penjualan/print/laporan_eMoney_month">
                    @csrf
                    <div class="mb-3">
                        <label for="date" class="form-label">Export PDF berdasarkan bulan penjualan</label>
                        <input type="month" class="form-control" id="date" name="month">
                    </div>
                    <button type="submit" class="btn btn-primary">Export</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <p class="py-5 text-center">Laporan Penjualan</p>
    </div>
@endsection


@section('script')
    {{-- datatables --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let i = 1
            $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('admin/laporan/e-money') }}",
                columns: [{
                        "render": function() {
                            return i++;
                        }
                    }, {
                        data: 'meja_id',
                        name: 'meja_id'
                    },
                    {
                        data: 'id_transaksi',
                        name: 'id_transaksi'
                    },
                    {
                        data: 'id_pemesanan',
                        name: 'id_pemesanan'
                    },
                    {
                        data: 'status_pemesanan',
                        name: 'status_pemesanan'
                    },
                    {
                        data: 'status_pembayaran',
                        name: 'status_pembayaran'
                    },
                    {
                        data: 'tipe_pembayaran',
                        name: 'tipe_pembayaran'
                    },
                    {
                        data: 'kode_pembayaran',
                        name: 'kode_pembayaran'
                    },
                    {
                        data: 'pdf_url',
                        name: 'pdf_url'
                    },
                    {
                        data: 'total_bayar',
                        name: 'total_bayar'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },

                ]
            });
        });
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
@endsection
