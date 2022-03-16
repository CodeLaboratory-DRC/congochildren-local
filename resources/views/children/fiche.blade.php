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
                                <h4 class="text-right my-7">
                                    Numéro de la fiche : <b class="text-uppercase">0114{{ $child->id }}</b> <br> <br>
                                    la contree de la mine ou du site minier concerne :<b class="text-capitalize">
                                        {{ $child->nomSite }}</b> <br> <br>
                                    Identification faite par : <b class="text-capitalize">
                                        {{ App\Models\User::getName($child->user_id) }}</b> <br> <br>
                                </h4>
                            </div>
                            <div class="col-lg-2 pr-0">
                                {!! QrCode::generate(URL::to('/') . '/api/identify/' . $id) !!}
                            </div>

                            <div class="col-lg-2 pr-0">
                                <img class="img-fluid" width="80px" height="80px"
                                    src="https://apple.kongochildren.org/api/image/{{ $id }}">
                            </div>

                            <div class="col-lg-2 pr-0">
                                <div class="btn-group" role="group" aria-label="Action Frais">
                                    <a href='{{ url("children/$id/print") }}' class="btn btn-sm btn-primary">
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
                                        <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                            class="text-uppercase text-dark"> <br>
                                            <b>{{ $child->nom }} </b>
                                        </a>
                                    </h5>
                                    <hr>
                                    <h5 class="mb-0">
                                        Genre :
                                        <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                            class="text-uppercase text-dark"> <br>
                                            <b>{{ $child->genre == 'm' ? 'Masculin' : 'Feminin' }}</b>
                                        </a>
                                    </h5>
                                    <hr>
                                    <h5 class="mb-0">
                                        Age ou année de naissance :
                                        <a data-bs-toggle="collapse" aria-controls="collapseOne" class="text-dark">
                                            <br>
                                            <b> {{ $child->age }}ans</b>
                                        </a>
                                    </h5>
                                    <hr>
                                    <h5 class="mb-0">
                                        Adresse :
                                        <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                            class="text-uppercase text-dark"> <br>
                                            <b>{{ $child->adresse }}</b>
                                        </a>
                                    </h5>
                                    <hr>
                                    <h5 class="mb-0">
                                        Contact :
                                        <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                            class="text-uppercase text-dark"> <br>
                                            <b>Téléphone: {{ $child->contact_princ .' | '. $child->contact_sec }}</b>
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
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        <b> {{ $child->parent_vie ? 'oui' : 'non' }}</b>
                                    </a>
                                    <br>
                                    @if ($child->parent_vie)
                                        <ul>
                                            <li>nom du pere: <span
                                                    class="text-uppercase"><b>{{ $child->nom_pere }}</b></span></li>
                                            <li>nom de la mere: <span
                                                    class="text-uppercase"><b>{{ $child->nom_mere }}</b></span></li>
                                        </ul> <br>
                                    @endif
                                </h5>
                                <hr>
                                <h5 class="mb-0">
                                    Déplacé résident ou retourné ?
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        <b>{{ $child->deplace == '1' ? 'oui' : 'non' }}</b>
                                    </a>
                                </h5>
                                <hr>
                                <h5 class="mb-0">
                                    Lieux où vit l'enfant :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        <b>{{ $child->habitation }}</b>
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
                                    Nom du pere:
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne" class=" text-dark"> <br>
                                        <span class="text-uppercase">{{ $child->nom_pere }}</span>
                                    </a>
                                </h5>
                                <hr>
                                <h5 class="mb-0">
                                    Nom du mere:
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne" class=" text-dark"> <br>
                                        <span class="text-uppercase">{{ $child->nom_mere }}</span>
                                        <br>
                                    </a>
                                </h5>
                                <hr>
                                <h5 class="mb-0">
                                    Niveau d'instruction du pere :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne" class=" text-dark"> <br>
                                        <span class="text-uppercase">{{ $child->instruction_pere }}</span>
                                    </a>
                                </h5>
                                <hr>
                                <h5 class="mb-0">
                                    Niveau d'instruction de la mere :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne" class=" text-dark"> <br>
                                        <span class="text-uppercase">{{ $child->instruction_mere }}</span>
                                        <br>
                                    </a>
                                </h5>
                                <hr>
                                <h5 class="mb-0">
                                    État matrimonial :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $child->matrimonial }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Nombre total des enfants
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne" class=" text-dark"> <br>
                                        {{ $child->nb_enfant }}enfant(s)
                                    </a>
                                </h5>
                                <hr>
                                <h5 class="mb-0">
                                    Nombre des garcons :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne" class=" text-dark"> <br>
                                        {{ $child->nb_homme }} garcons
                                    </a>
                                </h5>
                                <hr>
                                <h5 class="mb-0">
                                    Nombre des filles :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne" class=" text-dark"> <br>
                                        {{ $child->nb_femme }} filles
                                        <br>
                                    </a>
                                </h5>
                                <hr>
                                <h5 class="mb-0">
                                    Activité principale :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $child->activite_princ }}
                                    </a>
                                </h5>
                                <hr>
                                <h5 class="mb-0">
                                    Activité secondaire :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $child->activite_sec }}
                                    </a>
                                </h5>
                                <hr>
                                <h5 class="mb-0">
                                    Revénu journalier :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $child->revenu_jour }} CDF
                                    </a>
                                </h5>
                                <hr>
                                <h5 class="mb-0">
                                    Nombre d'enfants dans la mine :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $child->nb_enfant_mine }}
                                    </a>
                                </h5>
                                <hr>
                                <h5 class="mb-0">
                                    Rang de l'enfant intérrogé :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $child->rang_famille }}
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-section">
                    <div class="container-fluid bg-primary py-2">
                        <p class="mb-0 text-white rounded"> <b>SCOLARITE DE L'ENFANT</b></p>
                    </div>
                    <div id="accordion-1" class="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    A déjà été à l'école :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $child->etude ? 'OUI' : 'NON' }}
                                    </a>
                                </h5>
                                <hr>
                                @if ($child->etude)
                                    <h5 class="mb-0">
                                        Niveau d'étude :
                                        <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                            class="text-uppercase text-dark"> <br>
                                            {{ $child->niveauEtude }}
                                        </a>
                                    </h5>
                                    <hr>
                                    <h5 class="mb-0">
                                        Combinez-vous le travail et les études ?
                                        <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                            class="text-uppercase text-dark"> <br>
                                            {{ $child->travailEtude == null ? 'OUI' : 'NON' }}
                                        </a>
                                        @if ($child->travailEtude)
                                            <ul>
                                                <li>Raison: {{ $child->travailEtude }}</li>
                                            </ul>
                                        @endif
                                    </h5>
                                    <hr>
                                    <h5 class="mb-0">
                                        Qui prends en charge les frais scolaires ?
                                        <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                            class="text-uppercase text-dark"> <br>
                                            {{ $child->chargeFrais }}
                                        </a>
                                    </h5>
                                    <hr>
                                    <h5 class="mb-0">
                                        fréquentation de l'école/université/centre de formation selon l'horaire des cours :
                                        <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                            class="text-uppercase text-dark"> <br>
                                            {{ $child->horaire }}
                                        </a>
                                    </h5>
                                    <hr>
                                    <h5 class="mb-0">
                                        fréquentation de l'ecole/université/centre de formation par semaine :
                                        <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                            class="text-uppercase text-dark"> <br>
                                            {{ $child->frequentation }}fois/semaine
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
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $child->debut }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Personne ayant amené l'enfant dans la mine :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $child->ameneur }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Patron de l'enfant :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $child->patron }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Occupation dans la mine :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $child->occupation }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Maladies qui atteint les enfants dans la mine :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $child->maladie }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Accidents qui atteint les enfants dans la mine :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $child->accident }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Travail anterieur dans une autre mine :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $child->travail_ant }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Motivation de choix d'occupation :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $child->motivation }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Satisfaction dans la mine :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $child->satisfaction == null ? 'OUI' : 'NON' }}
                                    </a> <br>
                                    @if ($child->satisfaction)
                                        <ul>
                                            <li>Raison: {{ $child->satisfaction }}</li>
                                        </ul>
                                    @endif
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Lieu de traitement en cas de maladie/accident :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $child->soin }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    la distance entre le lieu de traitement et la maison :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne" class="text-dark"> <br>
                                        {{ $child->distance_soin }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    la distance entre le lieu de traitement et la mine :
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne" class=" text-dark"> <br>
                                        {{ $child->distance_mine }}
                                    </a>
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Avez-vous déjà pensé à quitter les mines ?
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $child->abandonner == null ? 'OUI' : 'NON' }}
                                    </a> <br>
                                    @if ($child->abandonner)
                                        <ul>
                                            <li>Raison: {{ $child->abandonner }}</li>
                                        </ul>
                                    @endif
                                </h5>
                                <hr>

                                <h5 class="mb-0">
                                    Vers quelle autres Activités aimeriez vous vous orienter à part celui dans la mine ?
                                    <a data-bs-toggle="collapse" aria-controls="collapseOne"
                                        class="text-uppercase text-dark"> <br>
                                        {{ $child->autre_activite == null ? 'OUI' : 'NON' }}
                                    </a><br>
                                    @if ($child->autre_activite)
                                        <ul>
                                            <li>Raison: {{ $child->autre_activite }}</li>
                                        </ul>
                                    @endif
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
