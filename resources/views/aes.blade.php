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

    <!-- Start AES Form -->
    <div class="container mt-5">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1><span class="d-block" style="font-size: 35px">AES Encryption/Decryption</span></h1>
                        <p class="mb-5"></p>

                    </div>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('crypto.process') }}" class="main-container" id="crypto-form">
            @csrf
            <p>Enter encryption key:</p>
            <span class="errorMsg1"><!-- Error message display here --></span>
            <input type="text" name="key" id="key" maxlength="100" autocomplete="off"
                class="form-control mb-3" style="background-color: #ffffe0; border-color: #3b5d50">

            <p>Enter your data for encryption / decryption:</p>
            <span class="errorMsg2"><!-- Error message display here --></span>
            <textarea name="data" id="data" rows="15" class="form-control mb-3"
                style="background-color: #ffffe0; border-color: #3b5d50"></textarea>

            <div class="radio-btns">
                <p>Choose the level of encryption:</p>
                <div class="form-check form-check-inline">
                    <input type="radio" name="encBit" value="128" id="rb1" class="form-check-input" checked>
                    <label for="rb1" class="form-check-label">128 Bit</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="encBit" value="192" id="rb2" class="form-check-input">
                    <label for="rb2" class="form-check-label">192 Bit</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="encBit" value="256" id="rb3" class="form-check-input">
                    <label for="rb3" class="form-check-label">256 Bit</label>
                </div>
            </div>

            <div class="mb-3">
                <button type="submit" name="operation" value="encrypt" class="btn btn-primary"
                    id="submitEncryptBtn">Encrypt</button>
                <button type="submit" name="operation" value="decrypt" class="btn btn-secondary"
                    id="submitDecryptBtn">Decrypt</button>
            </div>
        </form>
    </div>
    <!-- End AES Form -->


    <!-- Start Result Section -->
    <div class="container mt-5">
        <div class="show-result" id="resultContainer">
            <!-- Your result and key display code goes here -->
            <div class="showKey">
                <div class="row">
                    <div class="col-md-1">
                        <p>KEY</p>
                    </div>
                    <div class="col-md-11">
                        <textarea readonly="readonly" id="keyShow" class="form-control mb-2" rows="1"
                            style="background-color: #ffffe0; border-color: #3b5d50"></textarea>
                    </div>
                </div>
            </div>
            <div class="mt-3"></div>
            <div class="col-md-2">
                <p>Result Of Encryption</p>
            </div>
            <textarea readonly="readonly" id="result" class="form-control mb-3" cols="80" rows="15"
                style="background-color: #ffffe0; border-color: #3b5d50"></textarea>
            <button id="copyData" onclick="copyToClipboard('#result')" class="btn btn-primary">Copy to
                clipboard</button>
        </div>
        <div class="mt-3"></div>
    </div>
    <!-- End Result Section -->


    <!-- Your script includes go here -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Bootstrap JS (ensure you have it included in your project) -->
    <script src="{{ asset('/js/aes.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>



</body>

</html>
