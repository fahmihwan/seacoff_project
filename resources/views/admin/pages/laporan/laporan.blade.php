@extends('admin.layouts.main')

@section('styles')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css"> --}}
@endsection



@section('container')
    <div class="row">
        <div class="col-sm-12 mb-xl-0">
            <div class="d-flex bd-highlight ">
                <div class="me-auto p-2 bd-highlight">
                    <h5 class="text-dark font-weight-bold p-0 m-0">Laporan Penjualan</h5>
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
    <div class="row mb-3">
        <div class="col-md-12">
            <div style=" background-color: white; padding: 15px; width: auot;  overflow: scroll;">
                <table id="example" class="table table-hover display border " style="width: 1700px;">
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
                            <th>uang tunai</th>
                            <th>kembalian</th>
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
                            <th>uang tunai</th>
                            <th>kembalian</th>
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
                <form method="post" action="/admin/laporan/penjualan/print/laporan_date">
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
                <form method="post" action="/admin/laporan/penjualan/print/laporan_month">
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
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script> --}}

    {{-- datatables --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let i = 1;
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                processing: true,
                serverSide: true,
                ajax: "{{ url('admin/laporan/penjualan') }}",
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
                        data: 'uang_tunai',
                        name: 'uang_tunai'
                    },
                    {
                        data: 'kembalian',
                        name: 'kembalian'
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
