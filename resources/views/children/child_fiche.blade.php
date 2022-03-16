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
                                    Fiche de l'enfant : <b class="text-uppercase">{{ $child->nom . ' ' . $child->postnom . ' ' . $child->prenom }}</b> <br><br>
                                    Identification faites par : <b class="text-capitalize">{{ App\Models\User::getName($child->users_id) }}</b>
                                </h4>
                            </div>
                            <div class="col-lg-2 pr-0">
                                <div class="btn-group" role="group" aria-label="Action Frais">
                                    <a href='{{ url("children/$id/print") }}' class="btn btn-sm btn-primary">
                                        <i class="ti-printer btn-icon-append"> exporter la carte</i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="container-fluid d-flex justify-content-between">
                        <div class="col-lg-2 ps-0">
                            <p class="mt-5 mb-2"><b>IDENTIFICATION</b></p>
                            <hr>
                            <p style="font-size: 18px">
                                <b>Nom</b> : {{ $child->nom . ' ' . $child->postnom . ' ' . $child->prenom }} <br>
                                <b>ID</b> : {{ $child->initial }}<br>
                                <b>Age</b> : {{ $child->age }} ans<br>
                                <b>Genre</b> : {{ $child->sexe == 'm' ? 'Masculin' : 'Feminin' }}<br>
                                <b>Province</b> : {{ $site->province }}<br>
                                <b>Territoire</b> : {{ $site->territoire }}<br>
                                <b>Localité</b> : {{ $site->localite }}<br>
                                <b>Site</b> : {{ $site->nom }}<br>
                                <b>Parent en vie</b> : {{ $child->parentAlive == '1' ? 'oui' : 'non' }}<br>
                            </p>
                        </div>
                        @if ($child->parentAlive == 1)
                            <div class="col-lg-2 pr-0">
                                <p class="mt-5 mb-2 text-right"><b>PARENT</b></p>
                                <hr>
                                <p>
                                    <b>Vie chez le parent</b> : {{ $child->atHome == '1' ? 'oui' : 'non' }} <br>
                                    <b>Nom du Pere</b> : <span class="text-uppercase">{{ $child->nomPere }}</span> <br>
                                    <b>Nom de la mere</b> : <span class="text-uppercase">{{ $child->nomMere }}</span><br>
                                    <b>Niveau d'instruction du Pere</b> : <span class="text-uppercase">{{ $child->profilPere }}</span> <br>
                                    <b>Niveau d'instruction de la mere</b> : <span class="text-uppercase">{{ $child->profilMere }}</span><br>
                                    <b>Situation matrimoniale</b> : {{ $child->matrimonial }}<br>
                                    <b>Nombre d'enfants</b> : {{ $child->nombreEnfant }} enfants<br>
                                    <b>Rang occuper par l'enfant interroger</b> :
                                    {{ $child->rangEnfantInterroger }}ième<br>
                                    <b>Activité principal des parents</b> : {{ $child->activite }}<br>
                                    <b>Présence des membres de famille dans la mine</b> :
                                    {{ $child->familyInTheMine == '1' ? 'oui' : 'non' }} <br>
                                </p>
                            </div>
                        @endif
                        <div class="col-lg-2 pr-0">
                            <p class="mt-5 mb-2 text-right"><b>SCOLARITE</b></p>
                            <hr>
                            <p>
                                <b>Niveau d'étude</b> : {{ $child->niveau }} <br>
                                <b>Classe</b> : {{ $child->classe . ' ' . $child->etapeAbandon }}<br>
                                <b>Horaire de fréquentation de l'école</b> : {{ $child->horaire }} <br>
                                <b>Fréquentation de l'école</b> : {{ $child->frequentation }}jours/semaine <br>
                                {{-- <b>Pris en charge de frais scolaire</b> : <br>
                                <b>Combine travail et études</b> : --}}
                            </p>
                        </div>
                        <div class="col-lg-3 pr-0">
                            <p class="mt-5 mb-2 text-right"><b>ENQUETE</b></p>
                            <hr>
                            <p>
                                <b>Année du début travail dans la mine</b> : {{ $child->anneeDebut }} <br>
                                <b>Personne ayant amené l'enfant dans la mine</b> : {{ $child->amenerPar }}<br>
                                <b>Patron de l'enfant</b> : {{ $child->patron }}<br>
                                <b>Occupation</b> : {{ $child->occupation }}<br>
                                <b>Maladie qui atteint les enfants dans la mine</b> : {{ $child->maladie }} <br>
                                {{--  <b>Travail anterieur dans une autre mine</b> : <br>
                                <b>Motivation de choix d'occupation</b> : <br>
                                <b>Satisfaction </b> : <br>
                                <b>Lieu de traitement</b> : <br>
                                <b>Avez-vous déjà pensé à quitter les mines ?</b> : <br>
                                <b>Vers quelle autres Activités</b> : --}}
                            </p>
                        </div>
                        {{-- <div class="col-lg-2 pr-0">
                            <p class="mt-5 mb-2 text-right"><b></b></p>
                            <br><br>
                            <p>
                                <img src="{{ URL::to('/') }}/qrcodes/carteEnfant-{{ $child->id }}.svg">
                            </p>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
