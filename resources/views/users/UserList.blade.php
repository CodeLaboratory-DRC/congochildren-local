@extends('templates.app')
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des utilisateurs</h4>
                <p class="card-description">
                    liste des utilisateurs 
                </p>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom complet</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($agents->isNotEmpty())
                            @foreach ($agents as $agent)
                            <tr>
                                <td>{{ $agent->id }}</td>
                                <td>{{ $agent->nom }}</td>
                                <td>{{ $agent->phone }}</td>
                                <td>{{ $agent->email }}</td>
                                <td>{{ $agent->access }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Action Frais">
                                        <a href='{{ url("agent/$agent->id/detail")}}' class="btn btn-sm btn-primary">
                                            <i class="ti-file">Accèder aux Détails</i>
                                        </a>
                                        {{-- <a href='{{ url("agent/$agent->id/update")}}' class="btn btn-sm btn-danger">
                                            <i class="ti-file">Bloquer</i>
                                        </a> --}}
                                        {{-- <a href='{{ url("agent/$agent->id/delete")}}' class="btn btn-sm btn-danger">
                                            <i class="ti-trash">Supprimer</i>
                                        </a> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                            @else
                            <div class="alert alert-info text-center" alt="alert">
                                Aucun utilisateur existant
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