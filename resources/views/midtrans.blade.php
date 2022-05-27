<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
</head>

<body>
    <form action="/menu/payment/midtrans" id="submit_form" method="POST">
        @csrf
        <input type="hidden" name="data_json" value="" id="json_callback">
        <input type="text" name="menu_json" value="" id="menu_json_callback">
    </form>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                /* You may add your own implementation here */
                alert("payment success!");
                responsePayment(result)
            },
            onPending: function(result) {
                /* You may add your own implementation here */
                alert("wating your payment!");
                // console.log(result);
                responsePayment(result)
            },
            onError: function(result) {
                /* You may add your own implementation here */
                alert("payment failed!");
                // console.log(result);
                responsePayment(result)

            },
            onClose: function() {
                /* You may add your own implementation here */
                // alert('you closed the popup without finishing the payment');
                // window.location.href = '/menu/cart'
            }
        })


        function responsePayment(result) {
            document.getElementById('json_callback').value = JSON.stringify(result)
            document.getElementById('menu_json_callback').value = sessionStorage.getItem('detailOrder-list');
            document.getElementById('submit_form').submit();
        }
    </script>
</body>

</html>