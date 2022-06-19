<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a763e627e1.js" crossorigin="anonymous"></script>
    <title>scan</title>
    <style>
        /* span {
            color: white;

        } */

        body {
            /* background-color: #a03129; */
            background-color: #f6f6f6;
            /* background-color: white; */

        }


        #qr-reader__camera_selection::after {}


        #qr-reader__camera_selection {
            margin-bottom: 50px;
        }

        span a {
            visibility: hidden;
        }

        button {
            background-color: #ffc106;
            color: black;
            border-radius: 5px;
        }

        #qr-reader {

            padding-bottom: 200px;
        }

        #qr-reader__dashboard_section_swaplink {
            display: none;
        }
    </style>
</head>

<body>
    <div class="row" style="background-color: white">
        <div class="col-md-12 d-flex justify-content-between ">

            <div class=" bg-red">
                <a href="/home" class="px-3" style="line-height:40px;">
                    <i class=" fas fa-angle-left"></i>
                </a>
            </div>
            <div class="top-bar p-2">scan</div>
            <div class="top-bar p-2">...</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="qr-reader"></div>
            <div class="position-absolute bottom-0" style="margin: 0 auto 50px; width: 100%;">
                <p class="text-center text-light">scan Qrcode di meja anda</p>
            </div>
            <form method="post" action="/home/scan" hidden>
                @csrf
                <input type="text" name="qrcode" id="qrcode">
                <button type="submit">submit</button>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
    <script>
        const input = document.getElementById('qrcode');
        const form = document.getElementsByTagName('form')[0];
        console.log(form)
        console.log(input)

        function onScanSuccess(decodedText, decodedResult) {
            // alert(`Code scanned = ${decodedText}`, decodedResult);,
            // const result = decodedResult.decodedText
            input.value = decodedText;
            form.submit()
        }
        const qrcode = document.getElementById('qr-reader');

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", {
                fps: 10,
                qrbox: 250
            });
        html5QrcodeScanner.render(onScanSuccess);
    </script>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
