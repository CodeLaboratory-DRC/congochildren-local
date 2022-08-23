@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> Modification de la scolarité de: <b>{{ $enfant->nom }}</b> </h4>
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
                    <form class="forms-sample" method="POST" action="{{ route('scolarite.update', $scolarite->id) }}">
                        @csrf
                        <input type="text" name="user_id" value="{{ auth()->user()->id }}" hidden>
                        <div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="etude" class="col-sm-3 col-form-label">A déjà été à l'ecole ?</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="etude" id="etude" required>
                                                <option selected disabled value="">A déjà été à l'ecole ?</option>
                                                <option value="1" @if ($scolarite->etude == 1) selected @endif>Oui
                                                </option>
                                                <option value="0" @if ($scolarite->etude == 0) selected @endif>Non
                                                </option>
                                            </select>
                                            @error('etude')
                                                <span class="alert alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div id="etude-section"
                                        style="display: {{ $scolarite->etude == 1 ? 'block' : 'none' }}">
                                        <div class="form-group row">
                                            <label for="niveauEtude" class="col-sm-3 col-form-label">Niveau d'etude</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="niveauEtude">
                                                    <option selected disabled value="">Niveau d'etude</option>
                                                    <option value="Primaire"
                                                        @if ($scolarite->niveauEtude == 'Primaire') selected @endif>Primaire</option>
                                                    <option value="Secondaire"
                                                        @if ($scolarite->niveauEtude == 'Secondaire') selected @endif>Secondaire
                                                    </option>
                                                    <option value="Sans niveau d'instruction"
                                                        @if ($scolarite->niveauEtude == "Sans niveau d'instruction") selected @endif>Sans niveau
                                                        d'instruction</option>
                                                </select>
                                                @error('niveauEtude')
                                                    <span class="alert alert-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="chargeFrais" class="col-sm-3 col-form-label text-lowercase">Prise en
                                                charge des frais scolaires</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="chargeFrais">
                                                    <option selected disabled value="">Prise en charge des frais
                                                    </option>
                                                    <option @if ($scolarite->chargeFrais == 'Parents') selected @endif>Parents
                                                    </option>
                                                    <option @if ($scolarite->chargeFrais == 'Membre de la famille') selected @endif>Membre de la
                                                        famille</option>
                                                    <option @if ($scolarite->chargeFrais == 'ONG') selected @endif>ONG</option>
                                                    <option @if ($scolarite->chargeFrais == 'Gouvernement') selected @endif>Gouvernement
                                                    </option>
                                                    <option @if ($scolarite->chargeFrais == 'Soit même') selected @endif>Soit même
                                                    </option>
                                                    <option @if ($scolarite->chargeFrais == 'Autres') selected @endif>Autres
                                                    </option>
                                                </select>
                                                @error('chargeFrais')
                                                    <span class="alert alert-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="travailEtude" class="col-sm-3 col-form-label">Combine
                                                travail et etude</label>
                                            <div class="col-sm-9">
                                                @if ($scolarite->travailEtude !== null)
                                                    <input type="text" name="travailEtude"
                                                        value="{{ $scolarite->travailEtude }}" class="form-control"
                                                        id="travailEtude"
                                                        placeholder="Pourquoi combiner le travail et les etudes ?">
                                                @else
                                                    <select class="form-control" name="travailEtude">
                                                        <option selected disabled value="">Combine travail et etude ?
                                                        </option>
                                                        <option @if ($scolarite->travailEtude == null) selected @endif>Non
                                                        </option>
                                                        <option @if ($scolarite->travailEtude !== null) selected @endif>Oui
                                                        </option>
                                                    </select>
                                                @endif

                                                @error('travailEtude')
                                                    <span class="alert alert-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="horaire" class="col-sm-3 col-form-label">Horaire des cours</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="horaire">
                                                    <option selected disabled value="">Horaire d'etude</option>
                                                    <option @if ($scolarite->horaire == 'Avant-Midi') selected @endif>Avant-Midi
                                                    </option>
                                                    <option @if ($scolarite->horaire == 'Après-Midi') selected @endif>Après-Midi
                                                    </option>
                                                    <option @if ($scolarite->horaire == 'Alterne') selected @endif>Alterne
                                                    </option>
                                                </select>
                                                @error('horaire')
                                                    <span class="alert alert-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="frequentation" class="col-sm-3 col-form-label">Fréquentation de
                                                l'école/sémaine</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="frequentation">
                                                    <option selected disabled value="">fréquentation de
                                                        l'école/sémaine</option>
                                                    <option @if ($scolarite->frequentation == '6 Jrs / Semaine') selected @endif>6 Jrs /
                                                        Semaine</option>
                                                    <option @if ($scolarite->frequentation == '5 Jrs / Semaine') selected @endif>5 Jrs /
                                                        Semaine</option>
                                                    <option @if ($scolarite->frequentation == '4 Jrs / Semaine') selected @endif>4 Jrs /
                                                        Semaine</option>
                                                </select>
                                                @error('frequentation')
                                                    <span class="alert alert-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
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
    @push('scripts_etude')
        <script>
            $(document).ready(function() {
                $('#etude').on('change', function() {
                    if ($(this).val() == '1') {
                        $('#etude-section').show();
                    } else {
                        $('#etude-section').hide();
                    }
                });
            });
        </script>
    @endpush
@endsection
