@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-8 ps-0">
                                <h4 class="text-right my-7">Liste des coopératives agricoles dans la corbeille</h4>
                                <p class="card-description">
                                    liste des coopératives agricoles
                                </p>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="table-responsive pt-3">
                        @if (session('success'))
                            <div class="alert alert-info text-center msg" id="error">
                                <strong>{{ session('success') }}</strong>
                            </div>
                        @endif
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
                                                    {{-- <a href='{{ url("agricole/$agricole->id/restore") }}'
                                                        class="btn btn-sm btn-warning">
                                                        <i class="ti-back-left text-white"> Restorer</i>
                                                    </a>
                                                    <a href='{{ url("agricole/$agricole->id/remove") }}'
                                                        class="btn btn-sm btn-danger">
                                                        <i class="ti-close text-white"> Supprimer definitivement</i>
                                                    </a> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <div class="alert alert-info text-center" alt="alert">
                                        Aucune coopérative agricole dans la corbeille
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
