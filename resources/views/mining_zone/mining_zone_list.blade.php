@extends('templates.app')
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="container-fluid d-flex justify-content-between">
                        <div class="col-lg-8 ps-0">
                            <h4 class="card-title text-right my-7">Liste des sites</h4>
                            <p class="card-description">
                               Liste des sites dans la localite de <b class="text-uppercase">{{ $localite->localite }}</b>
                            </p>
                        </div>
                        <div class="col-lg-2 pr-0">
                            <div class="btn-group" role="group" aria-label="Action Frais">
                                <a href="{{ route ('site.print', $localite->id)}}" class="btn btn-sm btn-primary">
                                    <i class="ti-printer btn-icon-append"> imprimer la liste</i>                                                                              
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 pr-0">
                            <div class="btn-group" role="group" aria-label="Action Frais">
                                <a href="{{ route ('site.export', $localite->id)}}" class="btn btn-sm btn-success">
                                    <i class="ti-printer btn-icon-append"> Exporter vers excel</i>                                                                              
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
                                        <td class="text-capitalize">{{ $localite->province }}</td>
                                        <td class="text-capitalize">{{ $localite->territoire }}</td>
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
</div>
@endsection