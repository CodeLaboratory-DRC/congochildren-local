@extends('auth.layout')
@section('content')
    <h4>Nouveau ici ?</h4>
    <h6 class="font-weight-light">L'inscription est facile. Cela ne prend que quelques étapes</h6>
    @if (session('error'))
        <div class="alert alert-danger text-center msg" id="error">
            <strong>{{ session('error') }}</strong>
        </div>
    @endif
    <form class="pt-3" action="{{ route('register.post') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" name="username" value="{{ old('username') }}" class="form-control form-control-lg @error('username') is-invalid @enderror" id="exampleInputEmail1" placeholder="Nom...">
            @error('username')
                <span class="invalid-feedback" role="alert" >
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="text" name="email" value="{{ old('email') }}" class="form-control form-control-lg @error('email') is-invalid @enderror" id="exampleInputEmail1" placeholder="Telephone ou Email">
            @error('email')
                <span class="invalid-feedback" role="alert" >
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" name="password" value="{{ old('password') }}" class="form-control form-control-lg @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Mot de passe">
            @error('password')
                <span class="invalid-feedback" role="alert" >
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">S'IDENTIFIER</button>
        </div>
        <div class="text-center mt-4 font-weight-light">
            Vous avez déjà un compte? <a href="{{ route('login') }}" class="text-primary">S'identifier</a>
          </div>
    </form>
@endsection