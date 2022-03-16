@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-6 ps-0">
                                <h4 class="text-right my-7">Liste des coopératives agricoles</h4>
                                <p class="card-description">
                                    liste des coopératives agricoles
                                </p>
                            </div>
                            <div class="col-lg-6 pr-0">
                                <div class="btn-group" role="group" aria-label="Action Frais">
                                    <a href="{{ route('agricole.bin') }}" class="btn btn-sm btn-info">
                                        <i class="ti-eye btn-icon-append"></i>
                                        <i class="ti-trash btn-icon-append text-white"> Corbeille</i>
                                    </a>
                                </div>
                                <div class="btn-group" role="group" aria-label="Action Frais">
                                    <a href="{{ route('agricole.print') }}" class="btn btn-sm btn-primary">
                                        <i class="ti-printer btn-icon-append"> imprimer la liste</i>
                                    </a>
                                </div>
                                <div class="btn-group" role="group" aria-label="Action Frais">
                                    <a href="{{ route('agricole.export') }}" class="btn btn-sm btn-success">
                                        <i class="ti-printer btn-icon-append text-white"> exporter vers excel</i>
                                    </a>
                                </div>
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
                                            <td style="white-space: normal !important;">{{ $agricole->nom }}</td>
                                            <td>
                                                {{ $agricole->categorisation }}
                                            </td>
                                            <td style="white-space: normal !important;">{{ $agricole->nomGerant }}</td>
                                            <td>{{ $agricole->serviceAgrement }}</td>
                                            <td>{{ $agricole->domaine }}</td>
                                            <td>{{ $agricole->capaciteProduction }}</td>

                                            <td>
                                                <div class="btn-group" role="group" aria-label="Action Frais">
                                                    <a href='{{ url("agricole/$agricole->id/fiche") }}'
                                                        class="btn btn-sm btn-primary">
                                                        <i class="ti-file"> Détails</i>
                                                    </a>
                                                    {{-- <a href='{{ url("agricole/$agricole->id/update") }}'
                                                        class="btn btn-sm btn-warning">
                                                        <i class="ti-pencil-alt text-white"> Modifier</i>
                                                    </a>
                                                    <a href='{{ url("agricole/$agricole->id/delete") }}'
                                                        class="btn btn-sm btn-danger">
                                                        <i class="ti-trash text-white"> Supprimer</i>
                                                    </a> --}}
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
                    {{ $agricoles->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
@endsection
