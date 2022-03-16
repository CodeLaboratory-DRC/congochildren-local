<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" /> --}}
    <!--<link rel="stylesheet" href="style.css">-->
    <title>carte pabea - 0114{{ $data->id }}</title>
    <style>
        body {
            /* background-image: {{ public_path('carte/CarteRectoV1.png') }}; */
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            height: 100%;
        }

        div.page {
            position: relative;
            top: 210px;
        }

        .qrcode {
            position: absolute;
            right: 20;
            bottom: 200;
        }

        #block_container {
            display: flex;
            justify-content: ;
            margin-left: 150px;
        }

        #bloc1 {
            width: 500px;
            margin-right: 30px;
        }

        #bloc2 {
            margin-left: 250px;
            width: 700px;
            font-size: 45px;
        }


        span {
            color: white;
        }

    </style>
</head>

{{-- <body background="{{ asset('carte/CarteRectoV1.png') }}"> --}}

<body background="{{ public_path('carte/CarteRectoV1.png') }}">
    <div class="page">
        <div id="block_container">
            <div class="image-child" id="bloc1">
                {{-- on production --}}
                <?php
                
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_URL, "https://apple.kongochildren.org/api/image/$data->id");
                $image = curl_exec($ch);
                curl_close($ch);
                
                $base64 = 'data:image/png;base64,' . base64_encode($image);
                ?>
                <img src="{{ $base64 }}" alt="Image child"
                    style="width:170px; height: 170px; border-radius: 25% 10%;">
                {{-- local for test --}}
                {{-- <img src="{{ public_path() . '/qrcodes/qrcode-' . $data->id . '.svg' }}" alt="Image child"
                    style="width:170px; height: 170px; border-radius: 25% 10%;"> --}}

            </div>
            <div id="bloc2">
                <span>ID. 0114{{ $data->id }}</span><br>
                <span>Nom: {{ $data->nom }}</span><br>
                <span>Age: {{ $data->age }} Ans</span><br>
                <span>Genre: {{ $data->genre == 'm' ? 'Masculin' : 'Feminin' }}</span><br>
                <span>Site: {{ $data->nomSite }}</span><br>
                <span>Province: {{ $data->province }}</span>
            </div>
        </div>
        <div class="qrcode">
            {{-- {!! QrCode::generate(URL::to('/') . '/api/identify/' . $data->id) !!} --}}

            <img src="{{ public_path() . '/qrcodes/qrcode-' . $data->id . '.svg' }}" alt="qrcode"
                style="width:150px; height: 150px;">
        </div>
    </div>
</body>

</html>
