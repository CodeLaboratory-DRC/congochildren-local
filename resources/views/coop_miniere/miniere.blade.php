@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-6 ps-0">
                                <h4 class="text-right my-7">Liste des coopératives minières</h4>
                                <p class="card-description">
                                    liste des coopératives minières
                                </p>
                            </div>
                            <div class="col-lg-6 pr-0">
                                <div class="btn-group" role="group" aria-label="Action Frais">
                                    <a href="{{ route('mine.bin') }}" class="btn btn-sm btn-info">
                                        <i class="ti-eye btn-icon-append"></i>
                                        <i class="ti-trash btn-icon-append text-white"> Corbeille</i>
                                    </a>
                                </div>
                                <div class="btn-group" role="group" aria-label="Action Frais">
                                    <a href="{{ route('mine.print') }}" class="btn btn-sm btn-primary">
                                        <i class="ti-printer btn-icon-append"> imprimer la liste</i>
                                    </a>
                                </div>
                                <div class="btn-group" role="group" aria-label="Action Frais">
                                    <a href="{{ route('mine.export') }}" class="btn btn-sm btn-success">
                                        <i class="ti-printer btn-icon-append"> exporter vers excel</i>
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
                                    <th>Autre domaine</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($mines->isNotEmpty())
                                    @foreach ($mines->unique('nom') as $mine)
                                        <tr>
                                            <td>{{ $mine->id }}</td>
                                            <td style="white-space: normal !important;">{{ $mine->nom }}</td>
                                            <td>
                                                {{ $mine->categorisation }}
                                            </td>
                                            <td style="white-space: normal !important;">{{ $mine->nomGerant }}</td>
                                            <td>{{ $mine->serviceAgrement }}</td>
                                            <td>{{ $mine->domaine }}</td>
                                            <td style="white-space: normal !important;">{{ $mine->autreDomaines }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Action Frais">
                                                    <a href='{{ url("mine/$mine->id/fiche") }}'
                                                        class="btn btn-sm btn-primary">
                                                        <i class="ti-file">Détails</i>
                                                    </a>
                                                    {{-- <a href='{{ url("mine/$mine->id/update") }}'
                                                        class="btn btn-sm btn-warning">
                                                        <i class="ti-pencil-alt text-white"> Modifier</i>
                                                    </a>
                                                    <a href='{{ url("mine/$mine->id/delete") }}'
                                                        class="btn btn-sm btn-danger">
                                                        <i class="ti-trash text-white"> Supprimer</i>
                                                    </a> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <div class="alert alert-info text-center" alt="alert">
                                        Aucune coopérative minière existante
                                    </div>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{ $mines->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
@endsection
