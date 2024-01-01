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
            <div class="col-lg-10">
                <div class="intro-excerpt">
                    <h1><span class="d-block" style="font-size: 35px">RSA Decryption</span></h1>

                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="enkripsi" id="enkripsi-rsa">
                <div class="row">
                    <div class="col-md-2">
                        <p>RSA Private Key</p>
                    </div>
                    <div class="col-md-12">
                        <textarea id="private-key" class="form-control mb-3" rows="10"
                            style="background-color: #ffffe0; border-color: #3b5d50"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <p>Encrypted Text</p>
                    </div>
                    <div class="col-md-12">
                        <textarea id="encrypted-text" class="form-control mb-3" rows="10"
                            style="background-color: #ffffe0; border-color: #3b5d50"></textarea>
                    </div>
                </div>

            </div>
            <button class="btn btn-primary" id="button">Decrypt</button>
        </div>

        <div class="container mt-2">
            <div class="row">
                <div class="col-md-2">
                    <p>Decrypted Text</p>
                </div>
                <div class="col-md-12" id="result">
                    <textarea readonly="readonly" id="decrypted-text" class="form-control mb-3" cols="10" rows="8"
                        style="background-color: #ffffe0; border-color: #3b5d50"></textarea>
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
                var privateKey = document.getElementById("private-key");
                var encryptedText = document.getElementById("encrypted-text");
                var button = document.getElementById("button");
                var decryptedText = document.getElementById("decrypted-text");
                var result = document.getElementById("result");

                var success = function(data) {
                    decryptedText.value = new TextDecoder().decode(data);
                    decryptedDownload.href = window.URL.createObjectURL(
                        new Blob([decryptedText.value], {
                            type: "text/plain"
                        }));
                    result.style.display = "block";
                    message.innerText = null;
                    button.disabled = false;
                };

                var error = function(error) {
                    message.innerText = error;
                    button.disabled = false;
                };

                var process = function() {

                    button.disabled = true;

                    if (privateKey.value.trim() === "")
                        return error("Private key must be specified.");

                    var privateKeyArrayBuffer = null;
                    try {
                        privateKeyArrayBuffer = pemToArrayBuffer(privateKey.value.trim());
                    } catch (_) {
                        return error("Private key is invalid.");
                    }

                    if (encryptedText.value.trim() === "")
                        return error("Text to decrypt must be specified.");

                    var data = null;
                    try {
                        data = pemToArrayBuffer(encryptedText.value.trim());
                    } catch (_) {
                        return error("Encrypted text is invalid.");
                    }

                    rsaDecrypt(data, privateKeyArrayBuffer).then(success, error);
                };

                button.addEventListener("click", process);
            })();
        </script>
        <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>



</body>

</html>
