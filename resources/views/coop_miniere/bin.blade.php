@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-8 ps-0">
                                <h4 class="text-right my-7">Liste des coopératives minières dans la corbeille</h4>
                                <p class="card-description">
                                    liste des coopératives minières
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
                                                    {{-- <a href='{{ url("mine/$mine->id/restore") }}'
                                                        class="btn btn-sm btn-warning">
                                                        <i class="ti-back-left text-white"> Restorer</i>
                                                    </a>
                                                    <a href='{{ url("mine/$mine->id/remove") }}'
                                                        class="btn btn-sm btn-danger">
                                                        <i class="ti-close text-white"> Supprimer definitivement</i>
                                                    </a> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <div class="alert alert-info text-center" alt="alert">
                                        Aucune coopérative minière dans la corbeille
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
