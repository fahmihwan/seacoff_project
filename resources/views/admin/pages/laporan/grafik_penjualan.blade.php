@extends('admin.layouts.main')

@section('container')
    <div class="row">
        <div class="col-sm-12 mb-xl-0">
            <div class="d-flex bd-highlight ">
                <div class="me-auto p-2 bd-highlight">
                    <h5 class="text-dark font-weight-bold p-0 m-0">Laporan pembayaran cash</h5>
                    <p class="text-muted"> Last login was 23 hours ago. </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            Select Year : <select id='date-dropdown' class="form-control mb-2" style="width: 200px;" name="date">
            </select>

            <div class="card" style="width: 900px;">
                <canvas id="myChart"></canvas>
            </div>

            {{-- <div class="card mt-5" style="width: 900px;">
                <canvas id="myChart-line"></canvas>
            </div> --}}
        </div>
    </div>
    {{-- <form class="d-none">
        @foreach ($jml as $bulan)
            <input type="text" class="bulan" value="{{ $bulan }}">
        @endforeach
    </form> --}}
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // let data = []
        // const countMount = document.getElementsByClassName('bulan');
        // for (let i = 0; i <= countMount.length - 1; i++) {
        //     data.push(countMount[i].value)
        // }

        let dateDropdown = document.getElementById('date-dropdown');
        const formSubmit = document.getElementById('form-submit');
        let currentYear = new Date().getFullYear();
        let earliestYear = 2020;

        while (currentYear >= earliestYear) {
            let dateOption = document.createElement('option');
            dateOption.text = currentYear;
            dateOption.value = currentYear;
            dateDropdown.add(dateOption);
            currentYear -= 1;
        }

        ajaxListYear(new Date().getFullYear())

        dateDropdown.addEventListener('change', function(e) {
            ajaxListYear(e.target.value)
        })

        function ajaxListYear(year) {
            fetch(`/admin/laporan/${year}/grafik-penjualan`)
                .then(response => response.json())
                .then(res => {
                    chartBar(res)

                })
                .catch(err => console.log(err))
        }

        const ctx = document.getElementById('myChart').getContext('2d');

        function chartBar(data) {
            let obj = {
                type: 'bar',
                data: {
                    labels: ['Januari', 'Februari', 'Maret', 'Apil', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                        'Oktober', 'November', 'Desember'
                    ],
                    datasets: [{
                        label: 'Penjualan',
                        data: data,
                        backgroundColor: [
                            'rgb(70,77,238)',
                        ],
                        borderColor: [
                            'rgb(70,77,238)',
                        ],
                        borderWidth: 0.2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            }
            const myChart = new Chart(ctx, obj);
        }
    </script>

    {{-- <script>
        let tgl = []
        for (let i = 1; i <= 30; i++) {
            tgl.push(i)
        }

        const ctxx = document.getElementById('myChart-line').getContext('2d');
        const myChartt = new Chart(ctxx, {
            type: 'line',
            data: {
                labels: tgl,
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script> --}}
@endsection
