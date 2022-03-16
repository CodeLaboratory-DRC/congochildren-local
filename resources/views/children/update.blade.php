@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> Modification de l'enfant: <b>{{ $child->nom }}</b> </h4>
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
                    <form class="forms-sample" method="POST" action="{{ route('children.update', $id) }}">
                        @csrf
                        <input type="text" name="user_id" value="{{ auth()->user()->id }}" hidden>
                        <div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="site_id" class="col-sm-3 col-form-label">Nom du site</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="site_id" required>
                                                <option selected disabled value="">Selectionner le site</option>
                                                @foreach (App\Models\Site::all() as $site)
                                                    <option value="{{ $site->id }}" @if ($site->id == $child->site_id) selected @endif>
                                                        {{ $site->nom }}</option>
                                                @endforeach
                                            </select>
                                            @error('site_id')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nom" class="col-sm-3 col-form-label">Nom</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="nom" value="{{ $child->nom }}" class="form-control"
                                                id="nom" placeholder="Inserer le nom" required>
                                            @error('nom')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="age" class="col-sm-3 col-form-label">Age</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="age" required>
                                                @for ($age = 1; $age < 35; $age++)
                                                    <option value="{{ $age }}" @if ($child->age == $age) selected @endif>{{ $age }}</option>
                                                @endfor
                                            </select>
                                            @error('age')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="genre" class="col-sm-3 col-form-label">Genre</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="genre" required>
                                                <option selected disabled value="">Selectionner le genre</option>
                                                <option value="m" @if ($child->genre == 'm') selected @endif>Masculin</option>
                                                <option value="f" @if ($child->genre == 'f') selected @endif>Feminin</option>
                                            </select>
                                            @error('genre')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="adresse" class="col-sm-3 col-form-label">Adresse</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="adresse" value="{{ $child->adresse }}"
                                                class="form-control" id="adresse" placeholder="Inserer l'adresse">
                                            @error('adresse')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 offset-md-1">
                                    <div class="form-group row">
                                        <label for="parent_vie" class="col-sm-3 col-form-label">Parent en vie</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="parent_vie" required>
                                                <option selected disabled value="">Enfant avec parent en vie ?</option>
                                                <option value="0" @if ($child->parent_vie == '0') selected @endif>Non</option>
                                                <option value="1" @if ($child->parent_vie == '1') selected @endif>Oui</option>
                                            </select>
                                            @error('parent_vie')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="deplace" class="col-sm-3 col-form-label">Deplacé interne ou
                                            refugier</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="deplace" required>
                                                <option selected disabled value="">Deplacé interne ou refugier ?</option>
                                                <option value="0" @if ($child->deplace == '0') selected @endif>Non</option>
                                                <option value="1" @if ($child->deplace == '1') selected @endif>Oui</option>
                                            </select>
                                            @error('deplace')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="habitation" class="col-sm-3 col-form-label">Habitation</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="habitation" required>
                                                <option selected disabled value="">Habitation</option>
                                                <option @if (Str::lower($child->habitation) == Str::lower('Chez les deux parents')) selected @endif>Chez les deux parents</option>
                                                <option @if (Str::lower($child->habitation) == Str::lower('Domicile Personnel')) selected @endif>Domicile Personnel</option>
                                                <option @if (Str::lower($child->habitation) == Str::lower('Chez un membre de famille')) selected @endif>Chez un membre de famille</option>
                                                <option @if (Str::lower($child->habitation) == Str::lower('Chez la mère')) selected @endif>Chez la mère</option>
                                                <option @if (Str::lower($child->habitation) == Str::lower('Chez le père')) selected @endif>Chez le père</option>
                                                <option @if (Str::lower($child->habitation) == Str::lower('Chez les amis')) selected @endif>Chez les amis</option>
                                                <option @if (Str::lower($child->habitation) == Str::lower('A l\'Eglise')) selected @endif>A l'Eglise</option>
                                                <option @if (Str::lower($child->habitation) == Str::lower('Sans abris')) selected @endif>Sans abris</option>
                                                <option @if (Str::lower($child->habitation) == Str::lower('Autres')) selected @endif>Autres</option>
                                            </select>
                                            @error('habitation')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="rang_famille" class="col-sm-3 col-form-label">Rang dans la
                                            famille</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="rang_famille" value="{{ $child->rang_famille }}"
                                                class="form-control" id="rang_famille"
                                                placeholder="Inserer le rang dans la famille" required>
                                            @error('rang_famille')
                                                <span class="alert alert-danger" role="alert">
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
