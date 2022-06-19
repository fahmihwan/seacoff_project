<!DOCTYPE html>
<html>

<head>
    <title>Laravel 9 Generate PDF Example - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        table tr td,
        th {
            padding: 0px;
            margin: 0px;
        }
    </style>
</head>

<body>
    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.</p>

    <table class="table table-bordered">
        <tr>
            <th>no</th>
            <th>meja</th>
            {{-- <th>id transaksi</th> --}}
            {{-- <th>id pemesanan</th> --}}
            <th>status pemesanan</th>
            <th>status pembayaran</th>
            <th>tipe pembayaran</th>
            {{-- <th>kode pembayaran</th> --}}
            {{-- <th>pdf</th> --}}
            <th>total bayar</th>
            <th>uang tunai</th>
            <th>kembalian</th>
            {{-- <th>tgl transaksi</th> --}}
        </tr>
        @foreach ($reports as $report)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $report->meja_id }}</td>
                {{-- <td>{{ $report->id_transaksi }}</td> --}}
                {{-- <td>{{ $report->id_pemesanan }}</td> --}}
                <td>{{ $report->status_pemesanan }}</td>
                <td>{{ $report->status_pembayaran }}</td>
                <td>{{ $report->tipe_pembayaran }}</td>
                {{-- <td>{{ $report->kode_pembayaran }}</td> --}}
                {{-- <td>{{ $report->pdf_url }}</td> --}}
                <td>{{ $report->uang_tunai }}</td>
                <td>{{ $report->kembalian }}</td>
                <td>{{ $report->total_bayar }}</td>
                {{-- <td>{{ $report->created_at->format('d-m-Y') }}</td> --}}
            </tr>
        @endforeach

    </table>

</body>

</html>
