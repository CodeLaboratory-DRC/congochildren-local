@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> Modification de la cooperative agricole <b>{{ $agricole->nom }}</b> </h4>
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
                    <form class="forms-sample" method="POST" action="{{ route('agricole.update', $id) }}">
                        @csrf
                        <input type="text" name="users_id" value="{{ auth()->user()->id }}" hidden>
                        <div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="nom" class="col-sm-3 col-form-label">Nom </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="nom" value="{{ $agricole->nom }}"
                                                class="form-control" id="nom" placeholder="Inserer le nom" required>
                                            @error('nom')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="serviceAgrement" class="col-sm-3 col-form-label">Service
                                            d'Agrement</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="serviceAgrement"
                                                value="{{ $agricole->serviceAgrement }}" class="form-control"
                                                id="serviceAgrement" placeholder="Inserer le Service d'Agrement" required>
                                            @error('serviceAgrement')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="nomGerant" class="col-sm-3 col-form-label">Nom Gerant</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="nomGerant" value="{{ $agricole->nomGerant }}"
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
                                            <input type="text" name="domaine" value="{{ $agricole->domaine }}"
                                                class="form-control" id="domaine" placeholder="Inserer le domaine"
                                                required>
                                            @error('domaine')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="capaciteProduction" class="col-sm-3 col-form-label">Capacité de
                                            production</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="capaciteProduction" required>
                                                <option disabled value="">Selectionner une Capacité de production</option>
                                                <option
                                                    {{ $agricole->capaciteProduction == '0 à 50' ? 'selected' : '' }}>0 à
                                                    50 {{ $productionUnity }}</option>
                                                <option
                                                    {{ $agricole->capaciteProduction == '0 à 100' ? 'selected' : '' }}>50
                                                    à 100{{ $productionUnity }}</option>
                                                <option
                                                    {{ $agricole->capaciteProduction == '0 à 150' ? 'selected' : '' }}>
                                                    100 à 150{{ $productionUnity }}</option>
                                                <option
                                                    {{ $agricole->capaciteProduction == '0 à 200' ? 'selected' : '' }}>
                                                    150 à 200{{ $productionUnity }}</option>
                                                <option
                                                    {{ $agricole->capaciteProduction == '0 à 250' ? 'selected' : '' }}>
                                                    200 à 250{{ $productionUnity }}</option>
                                                <option
                                                    {{ $agricole->capaciteProduction == 'Plus de' ? 'selected' : '' }}>
                                                    Plus de{{ $productionUnity }}</option>
                                            </select>
                                            @error('capaciteProduction')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{--  --}}
                                    @if ($agricole->domaine == 'Production')
                                        <div class="form-group row">
                                            <label for="equipement" class="col-sm-3 col-form-label">Equipement de
                                                production</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="equipement"
                                                    value="{{ $agricole->equipement }}" class="form-control"
                                                    id="equipement" placeholder="Inserer un equipement de production">
                                                @error('equipement')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                    @if ($agricole->domaine == 'Transformation')
                                        <div class="form-group row">
                                            <label for="transformation"
                                                class="col-sm-3 col-form-label">Transformation</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="transformation"
                                                    value="{{ $agricole->transformation }}" class="form-control"
                                                    id="transformation" placeholder="Inserer une transformation">
                                                @error('transformation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-5 offset-md-1">
                                    <div class="form-group row">
                                        <label for="telephone" class="col-sm-3 col-form-label">Numero de téléphone</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="telephone" value="{{ $agricole->telephone }}"
                                                class="form-control" id="telephone" placeholder="Inserer le telephone"
                                                required>
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
                                            <input type="text" name="adresse" value="{{ $agricole->adresse }}"
                                                class="form-control" id="adresse" placeholder="Inserer l'adresse">
                                            @error('adresse')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Adresse e-mail</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="email" value="{{ $agricole->email }}"
                                                class="form-control" id="email"
                                                placeholder="Inserer l'adresse e-mail">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="website" class="col-sm-3 col-form-label">Site web</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="website" value="{{ $agricole->website }}"
                                                class="form-control" id="website" placeholder="Inserer le site web">
                                            @error('website')
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
