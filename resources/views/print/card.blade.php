<!DOCTYPE html>
<html>

<head>
    <title>Carte enfant</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"
        integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/html2canvas.min.js') }}"></script>

    <style>
        body {
            background-image: url({{ asset('carte/CarteRectoV1.png') }});
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            height: 100%;
        }

        .container {
            position: absolute;
            top: 60%;
            left: 50%;
            -moz-transform: translateX(-50%) translateY(-50%);
            -webkit-transform: translateX(-50%) translateY(-50%);
            transform: translateX(-50%) translateY(-50%);
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="row" style="margin-top: 40px">
            <div class="col-md-4">
                {{-- <img src="https://apple.kongochildren.org/api/image/{{ $data->id }}" alt="Image child"
                    style="width:150px; height: 150px; border-radius: 25% 10%;"> --}}
                <img src="{{ asset('carte/zetong-li-VAT6XKKwaIE-unsplash.jpg') }}" alt="Image child"
                    style="width:200px; height: 200px; border-radius: 25% 10%;">
            </div>
            <div class="col-md-8">
                <div class="text-white">
                    <h4>ID. 0114{{ $data->id }}</h4>
                    <h4>Nom: <span class="text-uppercase">{{ $data->nom }}</span></h4>
                    <h4>Age: <span class="text-uppercase">{{ $data->age }} Ans</span></h4>
                    <h4>Genre: <span class="text-uppercase">{{ $data->genre == 'm' ? 'Masculin' : 'Feminin' }}</span>
                    </h4>
                    <h4>Site: <span class="text-uppercase">{{ $data->nomSite }}</span></h4>
                    <h4>Province: <span class="text-uppercase">{{ $data->province }}</span></h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1 offset-md-11">
                {!! QrCode::size(100)->generate(URL::to('/') . '/api/identify/' . $data->id) !!}
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            html2canvas(document.body).then(function(canvas) {
                // document.body.appendChild(canvas);
            });
            console.log('into script');
        });
    </script>
</body>

</html>
