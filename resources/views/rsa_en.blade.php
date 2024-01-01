<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Untree.co">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('/css/tiny-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">

    <title>AES</title>
</head>

<body>
    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
        <div class="container">
            <a class="navbar-brand" href="/">ChiperZone<span>.</span></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/aes">AES</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="rsaDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            RSA
                        </a>
                        <div class="dropdown-menu" aria-labelledby="rsaDropdown">
                            <a class="dropdown-item" href="/rsa_en">Encryption</a>
                            <a class="dropdown-item" href="/rsa_de">Decryption</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Header/Navigation -->


    <!-- Mulai Form GENERATE KEY RSA -->
    <div class="container mt-5">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1><span class="d-block" style="font-size: 35px">RSA Encryption</span></h1>
                    <p class="mb-5"></p>
                </div>
            </div>
        </div>
        <p>Generate Key :</p>
        <button class="btn btn-primary" id="button">Generate Keys</button>
        <div id="message"></div>
        <div class="container mt-5">
            <div class="show-result" id="result-key">
                <div class="row">
                    <div class="col-md-2">
                        <p>RSA Public Key</p>
                    </div>
                    <div class="col-md-12">
                        <textarea readonly="readonly" id="public-key-text" class="form-control mb-3" cols="10" rows="8"
                            style="background-color: #ffffe0; border-color: #3b5d50"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <p>RSA Private Key</p>
                    </div>
                    <div class="col-md-12">
                        <textarea readonly="readonly" id="private-key-text" class="form-control mb-3" cols="10" rows="8"
                            style="background-color: #ffffe0; border-color: #3b5d50"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-2">
            <div class="intro-excerpt">
                <h1><span class="d-block" style="font-size: 25px">Encryption</span></h1>
                <p class="mb-5"></p>
            </div>
        </div>
        <div class="container mt-5">
            <div class="enkripsi" id="enkripsi-rsa">
                <div class="row">
                    <div class="col-md-2">
                        <p>RSA Public Key</p>
                    </div>
                    <div class="col-md-12">
                        <textarea id="public-key" class="form-control mb-3" rows="10"
                            style="background-color: #ffffe0; border-color: #3b5d50"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <p>Text to Encrypt</p>
                    </div>
                    <div class="col-md-12">
                        <textarea id="text-to-encrypt" class="form-control mb-3" rows="2"
                            style="background-color: #ffffe0; border-color: #3b5d50"></textarea>
                    </div>
                </div>
                <button class="btn btn-primary" id="button2-enkrip">Encrypt</button>

                <div id="message2"></div>
                <div class="row">
                    <div class="col-md-2">
                        <p>Encrypt Text</p>
                    </div>
                    <div class="col-md-12" id="result">
                        <textarea readonly="readonly" id="encrypted-text" class="form-control mb-3" cols="10" rows="8"
                            style="background-color: #ffffe0; border-color: #3b5d50"></textarea>
                    </div>
                </div>
            </div>
        </div>




        <!-- Your script includes go here -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <!-- Bootstrap JS (ensure you have it included in your project) -->
        <script src="{{ asset('/js/encoding-helper.js') }}"></script>
        <script src="{{ asset('/js/encryption-helper.js') }}"></script>

        <script>
            (function() {
                var publicKeyText = document.getElementById("public-key-text");
                // var publicKeyDownload = document.getElementById("public-key-download"); // Ini akan diperlukan jika Anda ingin menambahkan link download
                var privateKeyText = document.getElementById("private-key-text");
                // var privateKeyDownload = document.getElementById("private-key-download"); // Ini akan diperlukan jika Anda ingin menambahkan link download
                var button = document.getElementById("button");
                var message = document.getElementById("message");
                var result = document.getElementById("result-key");

                var success = function(keys) {
                    publicKeyText.value = arrayBufferToPem(keys.publicKeyBuffer, "RSA PUBLIC KEY");
                    // publicKeyDownload.href = window.URL.createObjectURL(new Blob([publicKeyText.value], { type: "application/octet-stream" }));
                    privateKeyText.value = arrayBufferToPem(keys.privateKeyBuffer, "RSA PRIVATE KEY");
                    // privateKeyDownload.href = window.URL.createObjectURL(new Blob([privateKeyText.value], { type: "application/octet-stream" }));
                    result.style.display = "block";
                    message.innerText = null;
                    button.disabled = false;
                };

                var error = function(error) {
                    message.innerText = error;
                    button.disabled = false;
                };

                var process = function() {
                    message.innerText = "Processing...";
                    button.disabled = true;
                    generateRsaKeys().then(success, error);
                };

                var warn = function() {
                    // if (privateKey.value === "") return; // privateKey belum didefinisikan di sini
                    return "Are you sure? Your keys will be lost unless you've saved them.";
                };

                button.addEventListener("click", process);
                window.onbeforeunload = warn;
            })();
            (function() {
                var publicKey = document.getElementById("public-key");
                var textToEncrypt = document.getElementById("text-to-encrypt");
                var button2 = document.getElementById("button2-enkrip");
                var message = document.getElementById("message2");
                var encryptedText = document.getElementById("encrypted-text");
                var encryptedDownload = document.getElementById("encrypted-download");
                var result = document.getElementById("result");

                var success = function(data) {
                    encryptedText.value = arrayBufferToPem(data, "RSA TEXT");
                    encryptedDownload.href = window.URL.createObjectURL(
                        new Blob([encryptedText.value], {
                            type: "text/plain"
                        }));
                    result.style.display = "block";
                    message.innerText = null;
                    button2.disabled = false;
                };

                var error = function(error) {
                    message.innerText = error;
                    button2.disabled = false;
                };

                var process = function() {
                    message.innerText = "Processing...";
                    button2.disabled = true;

                    if (publicKey.value.trim() === "")
                        return error("Public key must be specified.");

                    var publicKeyArrayBuffer = null;
                    try {
                        publicKeyArrayBuffer = pemToArrayBuffer(publicKey.value.trim());
                    } catch (_) {
                        return error("Public key is invalid.");
                    }

                    if (textToEncrypt.value.trim() === "")
                        return error("Text to encrypt must be specified.");

                    var data = new TextEncoder().encode(textToEncrypt.value);

                    rsaEncrypt(data, publicKeyArrayBuffer).then(success, error);
                };

                button2.addEventListener("click", process);
            })();
        </script>
        <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>



</body>

</html>
