@extends('templates.app')
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="container-fluid d-flex justify-content-between">
                        <div class="col-lg-8 ps-0">
                            <h4 class="card-title text-right my-7">Liste des localités</h4>
                        </div>
                        <!--<div class="col-lg-2 pr-0">-->
                        <!--    <div class="btn-group" role="group" aria-label="Action Frais">-->
                        <!--        <a href="{{ route('localite.print')}}" class="btn btn-sm btn-primary">-->
                        <!--            <i class="ti-printer btn-icon-append"> imprimer la liste</i>                                                                              -->
                        <!--        </a>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="col-lg-2 pr-0">-->
                        <!--    <div class="btn-group" role="group" aria-label="Action Frais">-->
                        <!--        <a href="{{ route('localite.export')}}" class="btn btn-sm btn-success">-->
                        <!--            <i class="ti-printer btn-icon-append"> exporter vers excel</i>                                                                              -->
                        <!--        </a>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                    <hr>
                </div>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Province</th>
                                <th>Territoire</th>
                                <th>Nombre des sites</th>
                                <th>Nombre d'enfants/jeunes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($sites->isNotEmpty())
                            <?php $j = 1; ?>
                                @foreach ($sites->unique('localite') as $localite)
                                    <tr>
                                        <td>{{ $j++}}</td>
                                        <td>{{ $localite->localite }}</td>
                                        <td>{{ $localite->province }}</td>
                                        <td>{{ $localite->territoire }}</td>
                                        <td>{{ App\Models\Site::countByLocalite($localite->localite)  }}</td>
                                        <td>
                                                {{ $nb_child = App\Models\Enfant::countByLocalite($localite->localite) }}
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Action Frais">
                                                <a href='{{ url("localite/$localite->localite")}}' class="btn btn-sm btn-primary">
                                                    <i class="ti-file">accèder aux sites</i>
                                                </a>
                                            </div>
                                            <div class="dropdown mt-1">
                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownDownload" data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="ti-download"></i>
                                                        Exporter les cartes
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownDownload">
                                                        <h6 class="dropdown-header">Par partie de 100 cartes</h6>
                                                        <?php
                                                        $nb_pages = ceil($nb_child / 100);
                                                        ?>
                                                        @for ($i = 1; $i <= $nb_pages; $i++)
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item"
                                                                href="{{ route('card.downpart', ['localite' => $localite->localite, 'part' => $i]) }}">
                                                                <i class="ti-download"></i>
                                                                Partie {{ $i }}
                                                            </a>
                                                        @endfor
                                                    </div>
                                                </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <div class="alert alert-info text-center" alt="alert">
                                    Aucune localité éxistante
                                </div>
                            @endif
                               
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection