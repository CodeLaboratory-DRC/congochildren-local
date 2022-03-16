@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> Modification de la structure </h4>
                    @if (session('success'))
                        <div class="alert alert-success text-center msg" id="error">
                            <strong>{{ session('success') }}</strong>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger text-center msg" id="error">
                            <strong>{{ session('error') }}</strong>
                        </div>
                    @endif
                    <form class="forms-sample" method="POST"
                        action="{{ route('fournisseur.update', $id) }}">
                        @csrf
                        <input type="text" name="users_id" value="{{ auth()->user()->id }}" hidden>
                        <div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="nom" class="col-sm-3 col-form-label">Nom </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="nom" value="{{ $fournisseur->nom }}"
                                                class="form-control" id="nom" placeholder="Inserer le nom" required>
                                            @error('nom')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="statutJuridique" class="col-sm-3 col-form-label">Statut
                                            Juridique</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="statutJuridique"
                                                value="{{ $fournisseur->statutJuridique }}" class="form-control"
                                                id="statutJuridique" placeholder="Inserer le statut juridique" required>
                                            @error('statutJuridique')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nomGerant" class="col-sm-3 col-form-label">Nom Gerant</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="nomGerant" value="{{ $fournisseur->nomGerant }}"
                                                class="form-control" id="phone"
                                                placeholder="Inserer le nom complet du gerant" required>
                                            @error('nomGerant')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="domaine" class="col-sm-3 col-form-label">Domaine</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="domaine" value="{{ $fournisseur->domaine }}"
                                                class="form-control" id="domaine" placeholder="Inserer le domaine" required>
                                            @error('domaine')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5  offset-md-1">
                                    <div class="form-group row">
                                        <label for="telephone" class="col-sm-3 col-form-label">Numero de telephone</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="telephone" value="{{ $fournisseur->telephone }}"
                                                class="form-control" id="telephone" placeholder="Inserer le telephone" required>
                                            @error('telephone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="adresse" class="col-sm-3 col-form-label">Adresse</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="adresse" value="{{ $fournisseur->adresse }}"
                                                class="form-control" id="adresse" placeholder="Inserer l'adresse" required>
                                            @error('adresse')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-block btn-primary">Mettre a jour</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
