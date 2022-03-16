@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body text-center">
                    <div>
                        @if (session('success'))
                            <div class="alert alert-success text-center msg" id="error">
                                <strong>{{ session('success') }}</strong>
                            </div>
                        @endif
                        <img src="{{ asset('images/faces/undraw_profile.svg') }}" class="img-lg rounded-circle mb-2" alt="profile image" />
                        <h4 class="text-uppercase">{{ auth()->user()->name }}</h4>
                        <p class="text-muted mb-0">
                            @if (auth()->user()->access == 'adminCentral')
                                Administrateur National
                            @else
                                Administrateur Provincial
                            @endif
                        </p>
                        <br>
                        <p class="mt-2">
                            <a href="{{ route('profil.update') }}" class="btn btn-dark">Mettre a jour les infos</a>
                            <a href="{{ route('password.store') }}" class="btn btn-success">Changer le mot de passe</a>
                        </p>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Infos personnelles</h4>
                    </div>

                    <div class="border-top pt-3">
                        <div class="row">
                            <div class="col-2">
                                <p>Province</p>
                                <h6 class="display-5">{{ $user->province }}</h6>
                            </div>
                            <div class="col-2">
                                <p>E-mail</p>
                                <h6 class="display-5">{{ $user->email }}</h6>
                            </div>
                            <div class="col-2">
                                <p>Téléphone</p>
                                <h6 class="display-5">{{ $user->phone }}</h6>
                            </div>
                            <div class="col-4">
                                <p>Adresse</p>
                                <h6 class="display-5">{{ $user->adresse }}</h6>
                            </div>
                            <div class="col-2">
                                <p>Activité Principal</p>
                                <h6 class="display-5">{{ $user->activite }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
