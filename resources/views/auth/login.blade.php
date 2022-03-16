<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>KONGO CHILDREN</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
    <link rel="shortcut icon" href="{{ asset('images/cd.svg') }}" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
        }

        .btn-lg {
            padding: 12px 26px;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        ::placeholder {
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        .form-control-lg {
            font-size: 16px;
            padding: 25px 20px;
        }

        .facebook-icon {
            background-color: #3b5b95;
            padding: 15px;
            border-radius: 100%;
        }

        .linkedin-icon {
            background-color: #077cb6;
            padding: 15px;
            border-radius: 100%;
        }

        .google-icon {
            background-color: #fff;
            padding: 15px;
            border-radius: 100%;
        }

        h6.separator {
            display: flex;
            width: 100%;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #666;
        }

        h6.separator:before,
        h6.separator:after {
            content: '';
            border-top: 1px solid #e4e7e8;
            margin: 0 20px 0 0;
            flex: 1 0 20px;
        }

        h6.separator:after {
            margin: 0 0 0 20px;
        }

        .features {
            text-align: center;
        }

        .owl-carousel .owl-item img {
            display: inline-block !important;
            width: auto !important;
        }

    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="row shadow-sm bg-white">
                    <div class="col-12 col-md-8 bg-white">
                        <h4 class="text-center text-dark mt-5">KONGO CHILDREN</h4>
                        <div class="text-dark mt-5">
                            <div class="features owl-theme owl-carousel">
                                <div>
                                  <img src="{{ asset('images/pabea/logo-pabea.png') }}" height="300px" width="400px"/>
                                    {{-- <h4>PABEA COBALT</h4>
                                    <p></p> --}}
                                </div>
                                <div> 
                                    <img src="{{ asset('images/pabea/image-icon-stop.png') }}" height="300px" width="400px"/>
                                    <p>Expoloitation artisanale</p>
                                </div>
                                <div>
                                  <img src="{{ asset('images/pabea/logo-bad.png') }}" height="300px" width="400px"/>
                                    {{-- <h4>enfant dans la mine</h4> --}}
                                    <p>Banque africaine de developpement</p>
                                </div>
                                <div class="bg-dark"> 
                                    <img src="{{ asset('images/pabea/logo-presidence-rdc.png') }}" height="300px" width="400px"/>
                                    <p>Présidence de la RDC</p>
                                </div>
                                <div> 
                                    <img src="{{ asset('images/pabea/logo-min-social.png') }}" height="300px" width="400px"/>
                                    <h4>RDC</h4>
                                    <p>Ministère des affaires sociales, action humanitaire et solidarité nationale</p>
                                </div>
                                <div> 
                                    <img src="{{ asset('images/pabea/logo-fnpss.png') }}" height="300px" width="400px"/>
                                    <p>FNPSS</p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="p-4">
                            <h4 class="text-center">Bienvenue, veuillez vous connecter</h4>
                            <hr>
                            @if (session('error'))
                                <div class="alert alert-danger text-center msg" id="error">
                                    <strong>{{ session('error') }}</strong>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success text-center msg" id="error">
                                    <strong>{{ session('success') }}</strong>
                                </div>
                            @endif
                            @if (session('msg'))
                                <div class="alert alert-info text-center msg" id="error">
                                    <strong>{{ session('msg') }}</strong>
                                </div>
                            @endif
                            <form action="{{ route('login.post') }}" method="POST">
                              @csrf
                                <input name="email" value="{{ old('email') }}"
                                    class="form-control form-control-lg mb-3" type="email" placeholder="Adresse Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input name="password" class="form-control form-control-lg" type="password"
                                    placeholder="Mot de passe">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                {{-- <div class="d-flex justify-content-between py-4">
                                    <div class="text-muted">
                                        <label>
                                            <input type="checkbox" name="remember" value="checkbox"
                                                id="CheckboxGroup1_0">
                                            &nbsp;
                                            Rester connecté</label>
                                    </div>
                                </div> --}}
                                <button type="submit" class="btn btn-dark btn-lg w-100">SE CONNECTER</button>
                            </form>
                            {{-- <p class="m-0 mt-4 text-muted">Don't have an account? <a href="" class="font-weight-bold">Sign Up</a></p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
    <script>
        $('.features').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 5000,
            responsive: {
                0: {
                    items: 1
                }
            }
        })
    </script>
</body>

</html>


{{-- @extends('auth.layout')
@section('content')

    <h4>Bienvenue!</h4>

    <form class="pt-3" action="{{ route('login.post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail">Adresse E-mail</label>
            <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-email text-primary"></i>
                    </span>
                </div>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="form-control form-control-lg @error('email') is-invalid @enderror" id="exampleInputEmail1"
                    placeholder="Votre Adresse E-mail">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword">Mot de passe</label>
            <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-lock text-primary"></i>
                    </span>
                </div>
                <input type="password" name="password"
                    class="form-control form-control-lg @error('password') is-invalid @enderror" id="exampleInputPassword1"
                    placeholder="Mot de passe">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SE
                CONNECTER</button>
        </div>
        <div class="my-2 d-flex justify-content-between align-items-center">
            <div class="form-check">
                <label class="form-check-label text-muted">
                    <input type="checkbox" name="remember" class="form-check-input">
                    Rester connecté
                </label>
            </div>
        </div>
    </form>


@endsection --}}
