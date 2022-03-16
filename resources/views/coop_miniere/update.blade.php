@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> Modification de la cooperative miniere <b>{{ $mine->nom }}</b> </h4>
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
                    <form class="forms-sample" method="POST" action="{{ route('mine.update', $id) }}">
                        @csrf
                        <input type="text" name="users_id" value="{{ auth()->user()->id }}" hidden>
                        <div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="nom" class="col-sm-3 col-form-label">Nom </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="nom" value="{{ $mine->nom }}" class="form-control"
                                                id="nom" placeholder="Inserer le nom" required>
                                            @error('nom')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="categorisation" class="col-sm-3 col-form-label">Categorisation</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="categorisation" required>
                                                <option selected disabled value="">Selectionner une categorisation</option>
                                                <option value="Coopérative Minière" @if ($mine->categorisation == 'Coopérative Minière') selected @endif>Coopérative
                                                    Minière</option>
                                                <option value="Exploitant artisanal" @if ($mine->categorisation == 'Exploitant artisanal') selected @endif>Exploitant
                                                    artisanal</option>
                                                <option value="Creuseur">Creuseur</option>
                                            </select>
                                            @error('categorisation')
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
                                            <input type="text" name="serviceAgrement" value="{{ $mine->serviceAgrement }}"
                                                class="form-control" id="serviceAgrement"
                                                placeholder="Inserer le Service d'Agrement" required>
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
                                            <input type="text" name="nomGerant" value="{{ $mine->nomGerant }}"
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
                                            young
                                            @error('domaine')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="autreDomaines" class="col-sm-3 col-form-label">Autre Domaines</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="autreDomaines" value="{{ $mine->autreDomaines }}"
                                                class="form-control" id="autreDomaines"
                                                placeholder="Inserer un autre domaine">
                                            @error('autreDomaines')
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
                                            <input type="text" name="telephone" value="{{ $mine->telephone }}"
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
                                            <input type="text" name="adresse" value="{{ $mine->adresse }}"
                                                class="form-control" id="adresse" placeholder="Inserer l'adresse"
                                                required>
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
                                            <input type="text" name="email" value="{{ $mine->email }}"
                                                class="form-control" id="email" placeholder="Inserer l'adresse e-mail"
                                                required>
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
                                            <input type="text" name="website" value="{{ $mine->website }}"
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
