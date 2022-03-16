@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> Modification de la famille <b>{{ $family->nom }}</b> </h4>
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
                    <form class="forms-sample" method="POST" action="{{ route('family.update', $family->id) }}">
                        @csrf
                        <input type="text" name="user_id" value="{{ auth()->user()->id }}" hidden>
                        <div>
                            <div class="row">
                                @if ($jeune->parent_vie)
                                    <div class="col-md-5">
                                        <div class="form-group row">
                                            <label for="nom_pere" class="col-sm-3 col-form-label">Nom du pere</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nom_pere" value="{{ $family->nom_pere }}"
                                                    class="form-control" id="nom_pere"
                                                    placeholder="Inserer le nom complet du pere">
                                                @error('nom_pere')
                                                    <span class="alert alert-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="instruction_pere" class="col-sm-3 col-form-label">Niveau
                                                d'instruction
                                                du pere</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="instruction_pere"
                                                    value="{{ $family->instruction_pere }}" class="form-control"
                                                    id="instruction_pere"
                                                    placeholder="Inserer le niveau d'instruction du pere">
                                                @error('instruction_pere')
                                                    <span class="alert alert-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nom_mere" class="col-sm-3 col-form-label">Nom de la mere</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nom_mere" value="{{ $family->nom_mere }}"
                                                    class="form-control" id="nom_mere"
                                                    placeholder="Inserer le nom complet de la mere">
                                                @error('nom_mere')
                                                    <span class="alert alert-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="instruction_mere" class="col-sm-3 col-form-label">Niveau
                                                d'instruction
                                                de la mere</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="instruction_mere"
                                                    value="{{ $family->instruction_mere }}" class="form-control"
                                                    id="instruction_mere"
                                                    placeholder="Inserer le niveau d'instruction de la mere">
                                                @error('instruction_mere')
                                                    <span class="alert alert-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="matrimonial" class="col-sm-3 col-form-label">Regime matrimonial des
                                                parents</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="matrimonial">
                                                    <option selected disabled value="">Selectionner le regime matrimonial
                                                    </option>
                                                    <option value="Monogame" @if ($family->matrimonial == 'Monogame') selected @endif>Monogame</option>
                                                    <option value="Polygame" @if ($family->matrimonial == 'Polygame') selected @endif>Polygame</option>
                                                </select>
                                                @error('matrimonial')
                                                    <span class="alert alert-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="activite_princ" class="col-sm-3 col-form-label">Activité principal
                                                des
                                                parents</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="activite_princ"
                                                    value="{{ $family->activite_princ }}" class="form-control"
                                                    id="activite_princ" placeholder="Inserer l'Activité prinicipal">
                                                @error('activite_princ')
                                                    <span class="alert alert-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="activite_sec" class="col-sm-3 col-form-label">Activité secondaire
                                                des
                                                parents</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="activite_sec"
                                                    value="{{ $family->activite_sec }}" class="form-control"
                                                    id="activite_sec"
                                                    placeholder="Inserer l'Activité secondaire des parents">
                                                @error('activite_sec')
                                                    <span class="alert alert-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="revenu_jour" class="col-sm-3 col-form-label">Revenu Journalier des
                                                parents(CDF)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="revenu_jour" value="{{ $family->revenu_jour }}"
                                                    class="form-control" id="revenu_jour"
                                                    placeholder="Inserer le revenu journalier des parents">
                                                @error('revenu_jour')
                                                    <span class="alert alert-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-6 offset-md-1">
                                    <div class="form-group row">
                                        <label for="nb_enfant" class="col-sm-3 col-form-label">Nombre d'enfant dans la
                                            famille</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="nb_enfant" value="{{ $family->nb_enfant }}"
                                                class="form-control" id="nb_enfant"
                                                placeholder="Inserer le nombre d'enfants" required>
                                            @error('nb_enfant')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nb_homme" class="col-sm-3 col-form-label">Nombre des garcons</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="nb_homme" value="{{ $family->nb_homme }}"
                                                class="form-control" id="nb_homme"
                                                placeholder="Inserer le nombre d'enfants garcon" required>
                                            @error('nb_homme')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nb_femme" class="col-sm-3 col-form-label">Nombre des filles</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="nb_femme" value="{{ $family->nb_femme }}"
                                                class="form-control" id="nb_femme"
                                                placeholder="Inserer le nombre d'enfants fille" required>
                                            @error('nb_femme')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nb_enfant_mine" class="col-sm-3 col-form-label">Nombre d'enfant de la
                                            famille dans la mine</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="nb_enfant_mine"
                                                value="{{ $family->nb_enfant_mine }}" class="form-control"
                                                id="nb_enfant_mine" placeholder="Inserer le nombre d'enfant dans la mine"
                                                required>
                                            @error('nb_enfant_mine')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- <h4 class="text-uppercase">Enfant dans la mine</h4>
                                    <hr> --}}
                                    {{-- @foreach ($freres as $frere)
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label for="nom" class="col-sm-12 col-form-label">Nom</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="nom" value="{{ $frere->nom }}"
                                                        class="form-control" id="nom"
                                                        placeholder="Inserer le nom de l'enfant" required>
                                                    @error('nom')
                                                        <span class="alert alert-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="nom" class="col-sm-12 col-form-label">Age</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="age" required>
                                                        @for ($age = 1; $age < 35; $age++)
                                                            <option value="{{ $age }}" @if ($frere->age == $age) selected @endif>
                                                                {{ $age }}</option>
                                                        @endfor
                                                    </select>
                                                    @error('age')
                                                        <span class="alert alert-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="sexe" class="col-sm-12 col-form-label">Sexe</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="sexe" required>
                                                        <option selected disabled value="">Selectionner le genre</option>
                                                        <option @if ($frere->sexe == 'Homme') selected @endif>Masculin</option>
                                                        <option @if ($frere->sexe == 'Femme') selected @endif>Feminin</option>
                                                    </select>
                                                    @error('sexe')
                                                        <span class="alert alert-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="instruction"
                                                    class="col-sm-12 col-form-label">Instruction</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="instruction"
                                                        value="{{ $frere->instruction }}" class="form-control"
                                                        id="instruction" placeholder="Inserer le nom de l'enfant" required>
                                                    @error('instruction')
                                                        <span class="alert alert-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach --}}
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
