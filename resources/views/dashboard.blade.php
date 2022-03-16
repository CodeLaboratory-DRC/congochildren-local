@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold text-capitalize">Bienvenue {{ auth()->user()->name }}!</h3>
                    <h6 class="font-weight-normal mb-0">Tous les systèmes fonctionnent correctement !</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Selon année d'entrer dans la mine</p>
                        <canvas id="order-chart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-4 grid-margin transparent">
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">Total Enfants</p>
                                <p class="fs-30 mb-2">{{ $nbEnfants = App\Models\Enfant::count('enfant') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Total Jeunes</p>
                                <p class="fs-30 mb-2">{{ $nbJeunes = App\Models\Enfant::count('jeune') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-4 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">Total Menages</p>
                                <p class="fs-30 mb-2">{{ App\Models\Famille::count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">Total Coop. Minières</p>
                                <p class="fs-30 mb-2">{{ App\Models\Miniere::count() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">Total Coop. Agricoles</p>
                                <p class="fs-30 mb-2">{{ App\Models\Agricole::count() }}</p>
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
                                                <h1 class="text-primary">{{ App\Models\Enfant::count() }}</h1>
                                                <h3 class="font-weight-500 mb-xl-4 text-primary">dans toute les localités</h3>
                                                <p class="mb-2 mb-xl-0">Le nombre total des enfants et jeunes recensés sur tous les sites.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xl-9">
                                            <div class="row">
                                                <div class="col-md-6 border-right">
                                                    <div class="table-responsive mb-3 mb-md-0 mt-3">
                                                        <table class="table table-borderless report-table">
                                                            @foreach ($sites->unique('localite')  as $localite)
                                                                <tr>
                                                                    <td class="text-muted text-capitalize">{{ $localite->localite }}</td>
                                                                    <td class="w-100 px-0">
                                                                        <div class="progress progress-md mx-4">
                                                                            <?php $nb_child = App\Models\Enfant::countByLocalite($localite->localite) ?>
                                                                            <div class="progress-bar bg-primary"
                                                                                role="progressbar" style="width: {{ ($nb_child > 0 ) ? '100%' : '0%' }}"
                                                                                aria-valuenow="70" aria-valuemin="0"
                                                                                aria-valuemax="100">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-weight-bold mb-0">{{ $nb_child }}</h5>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <canvas id="north-america-chart"></canvas>
                                                    <div id="north-america-legend"></div>
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
    <script>
        // window.addEventListener("load", function(){
            var tranche1 = {{ App\Models\Enfant::countByage(1) }};
            var tranche2 = {{ App\Models\Enfant::countByage(2) }};
            var tranche3 = {{ App\Models\Enfant::countByage(3) }};
            var stats = {{ json_encode(App\Models\Enquete::statsYear()) }}
            console.log(tranche3);
        // });
    </script>
@endsection
