@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card px-2">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-8 ps-0">
                                <h4 class="text-right my-7">
                                    Fiche du jeune : <b class="text-uppercase">{{ $younger->nom . ' ' . $younger->postnom . ' ' . $younger->prenom }}</b> <br><br>
                                    Identification faites par : <b class="text-capitalize">{{ App\Models\User::getName($younger->users_id) }}</b>
                                </h4>
                            </div>
                            <div class="col-lg-2 pr-0">
                                <a href='{{ url("younger/$younger->id/print") }}' class="btn btn-sm btn-primary">
                                    <i class="ti-printer btn-icon-append"> imprimer la carte</i>
                                </a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="container-fluid d-flex justify-content-between">
                        <div class="col-lg-4 ps-0">
                            <p class="mt-5 mb-2"><b>IDENTIFICATION</b></p>
                            <hr>
                            <p style="font-size: 18px">
								<b>ID</b> : {{ $younger->initial }}<br>
                                <b>Nom</b> : {{ $younger->nom . ' ' . $younger->postnom . ' ' . $younger->prenom }} <br>
                                <b>Age</b> : {{ $younger->age }} Ans<br>
                                <b>Genre</b> : {{ $younger->sexe == 'm' ? 'Masculin' : 'Feminin' }}<br>
                                <b>Province</b> : {{ $site->province }}<br>
                                <b>Territoire</b> : {{ $site->territoire }}<br>
                                <b>Localité</b> : {{ $site->localite }}<br>
                                <b>Site</b> : {{ $site->nom }}<br>
                                {{-- <b>Parent en vie</b> : {{ $younger->parentAlive == '1' ? 'oui' : 'non' }}<br> --}}
                            </p>
                        </div>
                        <div class="col-lg-4 pr-0">
                            <p class="mt-5 mb-2 text-right"><b>SCOLARITE</b></p>
                            <hr>
                            <p>
                                <b>Niveau d'étude</b> : {{ $younger->niveau }} <br>
                                <b>Classe</b> : {{ $younger->classe . ' ' . $younger->etapeAbandon }}<br>
                                <b>Horaire de fréquentation de l'école</b> : {{ $younger->horaire }} <br>
                                <b>Fréquentation de l'école</b> : {{ $younger->frequentation }}jours/semaine
                            </p>
                        </div>
                        <div class="col-lg-4 pr-0">
                            <p class="mt-5 mb-2 text-right"><b>ENQUETE</b></p>
                            <hr>
                            <p>
                                <b>Année du début</b> : {{ $younger->anneeDebut }} <br>
                                <b>Personne ayant amené l'enfant dans la mine</b> : {{ $younger->amenerPar }}<br>
								<b>Travail pour</b> : {{ $younger->patron }}<br>
								<b>Occupation</b> : {{ $younger->occupation }}<br>
                                <b>Maladie</b> : {{ $younger->maladie }}
                            </p>
                        </div>
                        {{-- <div class="col-lg-2 pr-0">
                            <p class="mt-5 mb-2 text-right"><b></b></p>
                            <br><br>
                            <p>
								<img src="{{ URL::to('/') }}/qrcodes/carteJeune-{{ $younger->id }}.svg" >
                            </p>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
