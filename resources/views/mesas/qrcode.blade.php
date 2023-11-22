<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Use a CDN link for the Html5QrcodeScanner library -->
    <script src="https://cdn.jsdelivr.net/gh/mebjas/html5-qrcode@2.0.2/dist/html5-qrcode.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            padding: 20px;
        }

        #reader {
            background: black;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        #result {
            margin-top: 20px;
            padding: 20px;
            background-color: #28a745;
            color: #fff;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- JavaScript library for QR code scanning -->
        <script src="https://reeteshghimire.com.np/wp-content/uploads/2021/05/html5-qrcode.min_.js"></script>

        <!-- Header -->
        <div>
            <!-- Display the webcam feed for QR code scanning -->
            <div id="reader"></div>

            <!-- Display the scan result on the side -->
            <div id="result">Result Here</div>
        </div>

        <script type="text/javascript">
            // Function to handle the success of QR code scanning
            function onScanSuccess(data) {
                // Redirect to the carrito page with mesa information
                window.location.href = '/example-app/public/cart?mesa=' + encodeURIComponent(data);
            }

            // Initialize the HTML5 QR code scanner
            var html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", { fps: 10, qrbox: 250 });
            // Render the scanner and pass the success callback
            html5QrcodeScanner.render(onScanSuccess);
        </script>
    </div>
    <hr/>
</body>

</html>