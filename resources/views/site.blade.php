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
                        <div class="col-lg-2 pr-0">
                            <div class="btn-group" role="group" aria-label="Action Frais">
                                <a href="{{ route('localite.print')}}" class="btn btn-sm btn-primary">
                                    <i class="ti-printer btn-icon-append"> imprimer la liste</i>                                                                              
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 pr-0">
                            <div class="btn-group" role="group" aria-label="Action Frais">
                                <a href="{{ route('localite.export')}}" class="btn btn-sm btn-success">
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
                                <th>Initial</th>
                                <th>Nom</th>
                                <th>Province</th>
                                <th>Territoire</th>
                                <th>Nombre des sites</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($localites->isNotEmpty())
                                @foreach ($localites as $localite)
                                    <tr>
                                        <td>{{ $localite->initial }}</td>
                                        <td>{{ $localite->intitule }}</td>
                                        <td>{{ $localite->province }}</td>
                                        <td>{{ $localite->territoire }}</td>
                                        <td>{{ $intitule = App\Models\Site::countByLocalite($localite->intitule)  }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Action Frais">
                                                <a href='{{ url("localite/$localite->id")}}' class="btn btn-sm btn-primary">
                                                    <i class="ti-file">accèder aux sites</i>
                                                </a>
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