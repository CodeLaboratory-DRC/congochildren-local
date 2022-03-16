@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="container-fluid d-flex justify-content-between"> 
                            <div class="col-lg-6 ps-0"> 
                                <h4 class="card-title mt-5 mb-2">Statistique du site {{ $site->nom }} </h4>
                                <p class="card-description">
                                    Dans la localité: <b>{{ $site->localite }}/{{ $site->province }} </b>
                                </p>
                            </div>
                            <div class="col-lg-2 pr-0"> 
                                <p class="card-title mt-5 mb-2 text-right">Total</p>
                                <h1 class="text-primary">{{ $children->count() }}</h1>
                            </div>
                            <div class="col-lg-2 pr-0">
                                <p class="card-title mt-5 mb-2 text-right">Enfants</p>
                                <h1 class="text-primary">{{ $nb_enfant }}</h1>
                            </div>
                            <div class="col-lg-2 pr-0"> 
                                <p class="card-title mt-5 mb-2 text-right">Jeunes</p>
                                <h1 class="text-primary">{{ $nb_jeune }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid d-flex justify-content-between"> 
                        <div class="col-lg-6 ps-0"> 
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mt-5 mb-2 text-right">Selon le Genre</h4>
                                    <canvas id="pieChart" width="823" height="411" style="display: block; width: 823px; height: 411px;"
                                        class="chartjs-render-monitor">
                                    </canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 pr-0"> 
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mt-5 mb-2 text-right">Selon l'age</h4>
                                    <canvas id="doughnutChart" width="823" height="411"
                                        style="display: block; width: 823px; height: 411px;" class="chartjs-render-monitor"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-8 ps-0">
                                <h4 class="text-right my-7">Liste des enfants et jeunes </b></h4>
                                <p class="card-description">
                                    liste des enfants et jeunes du site {{ $site->nom }}
                                </p>
                            </div>
                            <div class="col-lg-2 pr-0">
                                <!--<div class="btn-group" role="group" aria-label="Action Frais">-->
                                <!--    <a href="{{ route ('enfantYoung.print')}}" class="btn btn-sm btn-primary">-->
                                <!--        <i class="ti-printer btn-icon-append"> imprimer la liste</i>                                                                              -->
                                <!--    </a>-->
                                <!--</div>-->
                                <div class="btn-group" role="group" aria-label="Action Frais">
                                    <a href="{{ route ('child.site.export', $site->id)}}" class="btn btn-sm btn-success">
                                        <i class="ti-printer btn-icon-append"> exporter vers excel</i>                                                                              
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Age</th>
                                    <th>Genre</th>
                                    <th>Enqueteur</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($children->isNotEmpty())
                                    @foreach ($children as $child)
                                    <tr>
                                        <td>0114{{ $child->id }}</td>
                                        <td>{{ $child->nom }}</td>
                                        <td>{{ $child->age }}ans</td>
                                        <td>{{ ($child->genre == 'm') ? 'Masculin' : 'Feminin' }}</td>
                                        <td>
                                            {{ App\Models\User::getName($child->user_id); }}
                                          </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Action Frais">
                                                <a href='{{ url( (($child->age > 18 ) ? "young/" : "children/") . $child->id. "/fiche")}}' class="btn btn-sm btn-primary">
                                                    <i class="ti-file">Accèder aux Détails</i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <div class="alert alert-info text-center" alt="alert">
                                    Aucun enfant/jeune existant
                                    </div>
                                @endif   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-8 ps-0">
                              <h4 class="card-title text-right my-7">Liste des coopératives agricoles du site {{ $site->nom }}</h4>
                              <p class="card-description">liste des coopératives agricoles autour du site {{ $site->nom }}</p>
                            </div>
                            <div class="col-lg-2 pr-0">
                                <div class="btn-group" role="group" aria-label="Action Frais">
                                  <a href="{{ route ('agricole.print')}}" class="btn btn-sm btn-primary">
                                    <i class="ti-printer btn-icon-append"> imprimer la liste</i>                                                                              
                                  </a>
                                </div>
                              </div>
                              <div class="col-lg-2 pr-0">
                                <div class="btn-group" role="group" aria-label="Action Frais">
                                  <a href="{{ route ('agricole.export')}}" class="btn btn-sm btn-success">
                                    <i class="ti-printer btn-icon-append"> exporter vers excel</i>                                                                              
                                  </a>
                                </div>
                              </div>
                        </div>
                        <hr>
                    </div>
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Nom</th>
                                  <th>Catégorisation</th>
                                  <th>Gérant</th>
                                  <th>Service public d'agrement</th>
                                  <th>Domaine</th>
                                  <th>Capacité de production</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @if ($agricoles->isNotEmpty())
                                @foreach ($agricoles as $agricole)
                                <tr>
                                    <td>{{ $agricole->id }}</td>
                                    <td>{{ $agricole->nom }}</td>
                                    <td>
                                      {{ $agricole->categorisation }}
                                    </td>
                                    <td>{{ $agricole->nomGerant }}</td>
                                    <td>{{ $agricole->serviceAgrement }}</td>
                                    <td>{{ $agricole->domaine }}</td>
                                    <td>{{ $agricole->capaciteProduction }}</td>
                                    
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Action Frais">
                                            <a href='{{ url("agricole/$agricole->id/fiche")}}' class="btn btn-sm btn-primary">
                                                <i class="ti-file">Accèder aux détails</i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                  @endforeach
                              @else
                                <div class="alert alert-info text-center" alt="alert">
                                  Aucune coopérative agricole existante
                                </div>
                              @endif   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                      <div class="container-fluid d-flex justify-content-between">
                          <div class="col-lg-8 ps-0">
                            <h4 class="card-title text-right my-7">Liste des coopératives minières du site {{ $site->nom }}</h4>
                            <p class="card-description">
                              liste des coopératives minières autour du site {{ $site->nom }}
                            </p>
                          </div>
                          <div class="col-lg-2 pr-0">
                            <div class="btn-group" role="group" aria-label="Action Frais">
                                <a href="{{ route ('mine.print')}}" class="btn btn-sm btn-primary">
                                  <i class="ti-printer btn-icon-append"> imprimer la liste</i>                                                                              
                                </a>
                              </div>
                            </div>
                            <div class="col-lg-2 pr-0">
                              <div class="btn-group" role="group" aria-label="Action Frais">
                                <a href="{{ route ('mine.export')}}" class="btn btn-sm btn-success">
                                  <i class="ti-printer btn-icon-append"> exporter vers excel</i>                                                                              
                                </a>
                              </div>
                          </div>
                      </div>
                      <hr>
                    </div>
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Nom</th>
                                  <th>Catégorisation</th>
                                  <th>Gérant</th>
                                  <th>Service public d'agrement</th>
                                  <th>Domaine</th>
                                  <th>Autre domaine</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @if ($mines->isNotEmpty())
                                @foreach ($mines as $mine)
                                <tr>
                                    <td>{{ $mine->id }}</td>
                                    <td>{{ $mine->nom }}</td>
                                    <td>
                                      {{ $mine->categorisation }}
                                    </td>
                                    <td>{{ $mine->nomGerant }}</td>
                                    <td>{{ $mine->serviceAgrement }}</td>
                                    <td>{{ $mine->domaine }}</td>
                                    <td>{{ $mine->autreDomaines }}</td>
                                    
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Action Frais">
                                            <a href='{{ url("mine/$mine->id/fiche")}}' class="btn btn-sm btn-primary">
                                                <i class="ti-file">Accèder aux détails</i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                  @endforeach
                              @else
                                <div class="alert alert-info text-center" alt="alert">
                                  Aucune coopérative minière existante
                                </div>
                              @endif   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-8 ps-0">
                                <h4 class="text-right my-7">
                                        Liste des structure du secteur prive operationnelles dans l’agrobusiness du site {{ $site->nom }}
                                </h4>
                                <p class="card-description">
                                        Liste des structure du secteur prive operationnelles dans l’agrobusiness autour du site {{ $site->nom }}
                                </p>
                            </div>
                            <div class="col-lg-2 pr-0">
                                <div class="btn-group" role="group" aria-label="Action Frais">
                                    <a href="{{ route('fournisseur.print', 'agrobusiness') }}" class="btn btn-sm btn-primary">
                                        <i class="ti-printer btn-icon-append"> imprimer la liste</i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-2 pr-0">
                                <div class="btn-group" role="group" aria-label="Action Frais">
                                    <a href="{{ route('fournisseur.export', 'agrobusiness') }}" class="btn btn-sm btn-success">
                                        <i class="ti-printer btn-icon-append"> exporter vers excel</i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>

                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Catégorisation</th>
                                    <th>Gérant</th>
                                    <th>Status juridique</th>
                                    <th>Domaine</th>
                                    <th>Téléphone</th>
                                    <th>adresse</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($agrobusinesses->isNotEmpty())
                                    @foreach ($agrobusinesses as $agrobusiness)
                                        <tr>
                                            <td>{{ $agrobusiness->id }}</td>
                                            <td>{{ $agrobusiness->nom }}</td>
                                            <td>
                                                {{ $agrobusiness->categorisation }}
                                            </td>
                                            <td>{{ $agrobusiness->nomGerant }}</td>
                                            <td>{{ $agrobusiness->statutJuridique }}</td>
                                            <td>{{ $agrobusiness->domaine }}</td>
                                            <td>{{ $agrobusiness->telephone }}</td>
                                            <td>{{ $agrobusiness->adresse }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <div class="alert alert-info text-center" alt="alert">
                                        Aucune entreprise existante
                                    </div>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-8 ps-0">
                                <h4 class="text-right my-7">
                                        Liste des entreprises locales fournisseurs des materiaux de construction du site {{ $site->nom }}
                                </h4>
                                <p class="card-description">
                                        Liste des entreprises locales fournisseurs des materiaux de construction autour du site {{ $site->nom }}
                                </p>
                            </div>
                            <div class="col-lg-2 pr-0">
                                <div class="btn-group" role="group" aria-label="Action Frais">
                                    <a href="{{ route('fournisseur.print', 'fournisseur') }}" class="btn btn-sm btn-primary">
                                        <i class="ti-printer btn-icon-append"> imprimer la liste</i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-2 pr-0">
                                <div class="btn-group" role="group" aria-label="Action Frais">
                                    <a href="{{ route('fournisseur.export', 'fournisseur') }}" class="btn btn-sm btn-success">
                                        <i class="ti-printer btn-icon-append"> exporter vers excel</i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>

                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Catégorisation</th>
                                    <th>Gérant</th>
                                    <th>Status juridique</th>
                                    <th>Domaine</th>
                                    <th>Téléphone</th>
                                    <th>adresse</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($fournisseurs->isNotEmpty())
                                    @foreach ($fournisseurs as $fournisseur)
                                        <tr>
                                            <td>{{ $fournisseur->id }}</td>
                                            <td>{{ $fournisseur->nom }}</td>
                                            <td>
                                                {{ $fournisseur->categorisation }}
                                            </td>
                                            <td>{{ $fournisseur->nomGerant }}</td>
                                            <td>{{ $fournisseur->statutJuridique }}</td>
                                            <td>{{ $fournisseur->domaine }}</td>
                                            <td>{{ $fournisseur->telephone }}</td>
                                            <td>{{ $fournisseur->adresse }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <div class="alert alert-info text-center" alt="alert">
                                        Aucune entreprise existante
                                    </div>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var homme = {{ $nb_homme }}
        var femme = {{ $nb_femme }}
        var enfant ={{ $nb_enfant }}
        var jeune = {{ $nb_jeune }}
          console.log('nb_jeune:' + jeune);

    </script>
    @push('scripts')
        <script src="{{ asset('js/chart-site.js') }}"></script>
    @endpush
@endsection