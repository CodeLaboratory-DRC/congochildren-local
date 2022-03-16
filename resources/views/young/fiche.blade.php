@extends('templates.app')
@section('content')

    <!-- partial -->
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="card">
                <div class="card-body">
                    <div class="faq-section">
                        @if (session('success'))
                            <div class="alert alert-info text-center msg" id="error">
                                <strong>{{ session('success') }}</strong>
                            </div>
                        @endif
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-6 ps-0">
                                <h4 class="text-right my-6">
                                    Numéro de la fiche : <b class="text-uppercase">0114{{ $younger->id }}</b> <br> <br>
                                    la contree de la mine ou du site minier concerne :<b class="text-capitalize">
                                        {{ $younger->nomSite }}</b> <br> <br>
                                    Identification faite par : <b class="text-capitalize">
                                        {{ App\Models\User::getName($younger->user_id) }}</b> <br> <br>
                                </h4>
                            </div>
                            <div class="col-lg-2 pr-0">
                                {!! QrCode::generate(URL::to('/') . '/api/identify/0114' . $id) !!}
                            </div>
                            <div class="col-lg-2 pr-0">
                                <img class="img-fluid" width="70px" height="70px"
                                    src="https://apple.kongochildren.org/api/image/{{ $id }}">
                            </div>
                            <div class="col-lg-2 pr-0">
                                <div class="btn-group" role="group" aria-label="Action Frais">
                                    <a href='{{ url("younger/$id/print") }}' class="btn btn-sm btn-primary">
                                        <i class="ti-printer btn-icon-append"> exporter la carte</i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="container-fluid bg-primary py-2">
                            <p class="mb-0 text-white rounded"> <b>IDENTITE</b> </p>
                        </div>
                        <div id="accordion-1" class="accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        Nom :
                                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                            class="text-uppercase text-reset font-weight-bold"> <br>
                                            {{ $younger->nom }}
                                        </a>
                                    </h5>
                                    <hr>
                                    <h5 class="mb-0">
                                        Genre :
                                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                            class="text-uppercase text-dark"> <br>
                                            <b>{{ $younger->genre == 'm' ? 'Masculin' : 'Feminin' }}</b>
                                        </a>
                                    </h5>
                                    <hr>
                                    <h5 class="mb-0">
                                        Age ou année de naissance :
                                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                            class="text-dark"> <br>
                                            <b> {{ $younger->age }}ans</b>
                                        </a>
                                    </h5>
                                    <hr>
                                    <h5 class="mb-0">
                                        Adresse :
                                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                            class="text-uppercase text-dark"> <br>
                                            <b>{{ $younger->adresse }}</b>
                                        </a>
                                    </h5>
                                    <hr>
                                    <h5 class="mb-0">
                                        Contact :
                                        <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                            class="text-uppercase text-dark"> <br>
                                            <b>Téléphone: {{ $younger->contact_princ . ' | ' . $younger->contact_sec }}</b>
                                        </a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-section">
                    <div class="container-fluid bg-primary py-2">
                        <p class="mb-0 text-white rounded"> <b>STATUTS DES IDENTIFIES</b></p>
                    </div>
                    <div id="accordion-1" class="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    Enfant ayant leurs parents en vie ?
                                    <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        <b> {{ $younger->parent_vie == '1' ? 'oui' : 'non' }}</b>
                                    </a>
                                    <hr>
                                    @if ($younger->parent_vie == '1')
                                        <ul>
                                            <li>nom du pere: <span
                                                    class="text-uppercase"><b>{{ $younger->nom_pere }}</b></span></li>
                                            <li>nom de la mere: <span
                                                    class="text-uppercase"><b>{{ $younger->nom_mere }}</b></span></li>
                                        </ul> <br>
                                    @endif
                                </h5>
                                <h5 class="mb-0">
                                    Déplacé résident ou retourné ?
                                    <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        <b>{{ $younger->deplace == '1' ? 'oui' : 'non' }}</b>
                                    </a>
                                </h5>
                                <hr>
                                <h5 class="mb-0">
                                    Lieux où vit l'enfant :
                                    <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        <b>{{ $younger->habitation }}</b>
                                    </a>
                                </h5>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="faq-section">
                    <div class="container-fluid bg-primary py-2">
                        <p class="mb-0 text-white rounded"> <b>FAMILLE</b>
                        </p>
                    </div>
                    <div id="accordion-1" class="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    État civil:
                                    <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                        class=" text-dark"> <br>
                                        <span class="text-uppercase">{{ $jeune->etat_civil }}</span>
                                    </a> <br>
                                    @if ($younger->etat_civil == 'Marié(e)')
                                        <ul>
                                            <li>Nom du conjoint: <span
                                                    class="text-uppercase">{{ $jeune->coinjoint }}</span></li>
                                        </ul>
                                    @endif
                                </h5>
                                <hr>
                                @if ($younger->etat_civil == 'Marié(e)')
                                    <h5 class="mb-0">
                                        Nombre total des enfants
                                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                            class=" text-dark"> <br>
                                            {{ $jeune->nb_enfant }}enfant(s)
                                        </a> <br>
                                    </h5>
                                    <hr>
                                    <h5 class="mb-0">
                                        Nombre des garcons :
                                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                            class=" text-dark"> <br>
                                            {{ $jeune->nb_garcon }} garcons
                                        </a>
                                    </h5>
                                    <hr>
                                    <h5 class="mb-0">
                                        Nombre des filles :
                                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                            class=" text-dark"> <br>
                                            {{ $jeune->nb_fille }} filles
                                            <br>
                                        </a>
                                    </h5>
                                    <hr>
                                    <h5 class="mb-0">
                                        Nombre des enfants scolorisés :
                                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                            class=" text-dark"> <br>
                                            {{ $jeune->nb_scolarise }} enfants
                                            <br>
                                        </a>
                                    </h5>
                                    <hr>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                <div class="faq-section">
                    <div class="container-fluid bg-primary py-2">
                        <p class="mb-0 text-white rounded"> <b>SCOLARITE DU JEUNE</b></p>
                    </div>
                    <div id="accordion-1" class="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    Etude :
                                    <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        <b>{{ $younger->etude == '1' ? 'oui' : 'non' }}</b>
                                    </a>
                                </h5>
                                <hr>
                                @if ($younger->etude == '1')
                                    <h5 class="mb-0">
                                        Niveau d'étude :
                                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                            class="text-uppercase text-dark"> <br>
                                            {{ $younger->niveauEtude }}
                                        </a>
                                    </h5>
                                    <hr>
                                    <h5 class="mb-0">
                                        Combinez-vous le travail et les études ?
                                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                            class="text-uppercase text-dark"> <br>
                                            {{ $younger->travailEtude == null ? 'non' : 'oui' }}
                                        </a> <br>
                                        @if ($younger->travailEtude !== null)
                                            <ul>
                                                <li>{{ $younger->travailEtude }} </li>
                                            </ul>
                                        @endif
                                    </h5>
                                    <hr>
                                    <h5 class="mb-0">
                                        Qui prends en charge les frais scolaires ?
                                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                            class="text-uppercase text-dark"> <br>
                                            {{ $younger->chargeFrais }}
                                        </a>
                                    </h5>
                                    <hr>
                                    <h5 class="mb-0">
                                        fréquentation de l'école/université/centre de formation selon l'horaire des cours :
                                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                            class="text-uppercase text-dark"> <br>
                                            {{ $younger->horaire }}
                                        </a>
                                    </h5>
                                    <hr>
                                    <h5 class="mb-0">
                                        fréquentation de l'ecole/université/centre de formation par semaine :
                                        <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                            class="text-uppercase text-dark"> <br>
                                            {{ $younger->frequentation }}
                                        </a>
                                    </h5>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-section">
                    <div class="container-fluid bg-primary py-2">
                        <p class="mb-0 text-white rounded"> <b>ENQUETE</b></p>
                    </div>
                    <div id="accordion-1" class="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    Année du début du travail dans la mine :
                                    <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $younger->debut }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Personne ayant amené le jeune dans la mine :
                                    <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $younger->ameneur }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Patron du jeune :
                                    <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $younger->patron }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Occupation du jeune dans la mine :
                                    <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $younger->occupation }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Maladies qui atteint les jeunes dans la mine :
                                    <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $younger->maladie }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Accidents qui atteint les jeunes dans la mine :
                                    <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $younger->accident }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Travail anterieur dans une autre mine :
                                    <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $younger->travail_ant }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Motivation de choix d'occupation :
                                    <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $younger->motivation }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Satisfaction dans la mine :
                                    <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $younger->satisfaction }}
                                    </a> <br>
                                    @if ($younger->satisfaction == 'oui')
                                        <ul>
                                            <li>Raison ? </li>
                                        </ul>
                                    @endif
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Lieu de traitement en cas de maladie/accident :
                                    <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $younger->soin }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    la distance entre le lieu de traitement et la maison :
                                    <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                        class="text-dark"> <br>
                                        {{ $younger->distance_soin }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    la distance entre le lieu de traitement et la mine :
                                    <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                        class=" text-dark"> <br>
                                        {{ $younger->distance_mine }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Avez-vous déjà pensé à quitter les mines ?
                                    <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $younger->abandonner }}
                                    </a> <br>
                                    @if ($younger->abandonner == 'oui')
                                        <ul>
                                            <li>Pourquoi</li>
                                        </ul>
                                    @endif
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Vers quelle autres Activités aimeriez vous vous orienter à part celui dans la mine ?
                                    <a data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $younger->autre_activite }}
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
