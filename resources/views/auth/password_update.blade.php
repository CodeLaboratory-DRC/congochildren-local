@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> Modifier votre mot de passe
                    </h4>
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
                    <form class="forms-sample" method="POST"
                        action="{{ route('password.store', ['url' => $destination]) }}">
                        @csrf
                        <div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label">Nouveau mot de passe </label>
                                        <div class="col-sm-9">
                                            <input type="password" name="password" class="form-control" id="password"
                                                placeholder="Inserer le nouvau mot de passe">
                                            @error('password')
                                                <span class="alert alert-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="password_confirmation" class="col-sm-3 col-form-label">Confirmez le
                                            nouveau mot de passe</label>
                                        <div class="col-sm-9">
                                            <input type="password" name="password_confirmation" class="form-control"
                                                id="password_confirmation" placeholder="Confirmer le meme mot de passe">
                                            @error('password_confirmation')
                                                <span class="alert alert-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary ">mettre à jour </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
