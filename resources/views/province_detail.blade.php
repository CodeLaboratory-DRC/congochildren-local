@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Détail de la province du {{ $name }}!</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="row">
            <div class="col-md-9 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Selon année d'entrer dans la mine</p>
                        <canvas id="province-chart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-3 grid-margin transparent">
                <div class="row">
                    <div class="col-md-12 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">Total Enfants</p>
                                <p class="fs-30 mb-2">{{ App\Models\Enfant::countLocal('enfant',$name) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Total Jeunes</p>
                                <p class="fs-30 mb-2">{{ App\Models\Enfant::countLocal('jeune',$name) }}</p>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-md-12 mb-4 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">Total des ouvrages communautaires</p>
                                <p class="fs-30 mb-2">{{ App\Models\Communaute::countLocal($name) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-4 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">Total des agrobusiness</p>
                                <p class="fs-30 mb-2">{{ App\Models\AgroBusiness::countLocal($name) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card position-relative">
                    <div class="card-body">
                        <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2"
                            data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                            <div class="ml-xl-4 mt-3">
                                                <p class="card-title">Rapports détaillés</p>
                                                <h1 class="text-primary">{{ App\Models\Enfant::countLocal(null,$name) }}</h1>
                                                <h3 class="font-weight-500 mb-xl-4 text-primary">dans toute les localités</h3>
                                                <p class="mb-2 mb-xl-0">Le nombre total des enfants et jeunes recensés sur tous les sites.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xl-9">
                                            <div class="row">
                                                <div class="col-md-6 border-right">
                                                    <div class="table-responsive mb-3 mb-md-0 mt-3">
                                                        <table class="table table-borderless report-table">
                                                            @foreach ($localites as $localite)
                                                                <tr>
                                                                    <td class="text-muted">{{ $localite->intitule }}</td>
                                                                    <td class="w-100 px-0">
                                                                        <div class="progress progress-md mx-4">
                                                                            <div class="progress-bar bg-primary"
                                                                                role="progressbar" style="width: {{ ($kipushi = App\Models\Enfant::countByLocalite('kipushi')) ? 100 : 0 }}%"
                                                                                aria-valuenow="70" aria-valuemin="0"
                                                                                aria-valuemax="100">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-weight-bold mb-0">{{ $kipushi }}</h5>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <canvas id="north-america-chart-province"></canvas>
                                                    <div id="north-america-legend-province"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                <h4 class="card-title">Liste des sites</h4>
                <p class="card-description">
                    liste des sites
                </p>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Initiale</th>
                                <th>Nom</th>
                                <th>Province</th>
                                <th>Territoire</th>
                                <th>Responsable</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($sites->isNotEmpty())
                                <?php $i =0; ?>
                                @foreach ($sites as $site)
                                    <tr>
                                        <th>{{ ++$i }}</th>
                                        <td>{{ $site->initial }}</td>
                                        <td class="text-capitalize">{{ $site->nom }}</td>
                                        <td class="text-capitalize">{{ $site->province }}</td>
                                        <td class="text-capitalize">{{ $site->territoire }}</td>
                                        <td class="text-capitalize">{{ $site->responsable }}{{ ($site->phone) ?  (' - ' .$site->phone) : '' }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Action Frais">
                                                <a href='{{ url("site/$site->id")}}' class="btn btn-sm btn-primary">
                                                    <i class="ti-file">accèder aux details</i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <div class="alert alert-info text-center" alt="alert">
                                    Aucun site éxistant dans cette localité
                                </div>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        var tranche1 = {{ App\Models\Enfant::countByage(1, $name) }};
        var tranche2 = {{ App\Models\Enfant::countByage(2, $name) }};
        var tranche3 = {{ App\Models\Enfant::countByage(3, $name) }};
        var stats = {{ json_encode(App\Models\Enquete::statsYear($name)) }}
    </script>
@endsection
