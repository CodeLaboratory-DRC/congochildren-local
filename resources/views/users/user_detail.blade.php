@extends('templates.app')
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title float-left">Fiche de {{$agent->nom}}</h4>
                
                <a href='{{ url("users/$agent->id/state")}}' class="btn @if($agent->state == 'active') btn-danger @else btn-info Débloquer @endif btn-icon-text float-right">
                    <i class="ti-lock btn-icon-append"></i>
                    @if ($agent->state == 'active') Bloquer @else Débloquer @endif
                </a>

                <div class="table-responsive pt-3">
                    @if (session('success'))
                        <div class="alert alert-success text-center msg" id="error">
                            <strong>{{ session('success') }}</strong>
                        </div>
                    @endif
                        
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom complet</th>
                                <th>Téléphone</th>
                                <th>Adresse mail</th>
                                <th>Adresse physique</th>
                                <th>Activités primaires</th>
                                <th>Niveau d'accès</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $agent->id }}</td>
                                <td>{{ $agent->nom }}</td>
                                <td>{{ $agent->phone }}</td>
                                <td>{{ $agent->email }}</td>
                                <td>{{ $agent->adresse }}</td>
                                <td>{{ $agent->activite }}</td>
                                <td>{{ $agent->access }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection