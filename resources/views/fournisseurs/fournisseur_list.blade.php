@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-6 ps-0">
                                <h4 class="text-right my-7">
                                    @if ($type == 'fournisseur')
                                        Liste des entreprises locales fournisseurs des materiaux de construction
                                    @else
                                        Liste des structure du secteur prive operationnelles dans l’agrobusiness
                                    @endif

                                </h4>
                                <p class="card-description">
                                    @if ($type == 'fournisseur')
                                        Liste des entreprises locales fournisseurs des materiaux de construction
                                    @else
                                        Liste des structure du secteur prive operationnelles dans l’agrobusiness
                                    @endif
                                </p>
                            </div>
                            <div class="col-lg-6 pr-0">
                                <div class="btn-group" role="group" aria-label="Action Frais">
                                    <a href="{{ route('fournisseur.bin', $type) }}" class="btn btn-sm btn-info">
                                        <i class="ti-eye btn-icon-append"></i>
                                        <i class="ti-trash btn-icon-append text-white"> Corbeille</i>
                                    </a>
                                </div>
                                <div class="btn-group" role="group" aria-label="Action Frais">
                                    <a href="{{ route('fournisseur.print', $type) }}" class="btn btn-sm btn-primary">
                                        <i class="ti-printer btn-icon-append"> imprimer la liste</i>
                                    </a>
                                </div>
                                <div class="btn-group" role="group" aria-label="Action Frais">
                                    <a href="{{ route('fournisseur.export', $type) }}" class="btn btn-sm btn-success">
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
                                    {{-- <th>Catégorisation</th> --}}
                                    <th>Gérant</th>
                                    <th>Status juridique</th>
                                    <th>Domaine</th>
                                    <th>Téléphone</th>
                                    <th>Adresse</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if ($fournisseurs->isNotEmpty())
                                    @foreach ($fournisseurs->unique('nom') as $fournisseur)
                                        <tr>
                                            <td>{{ $fournisseur->id }}</td>
                                            <td style="white-space: normal !important;">{{ $fournisseur->nom }}</td>
                                            {{-- <td>
                                                {{ $fournisseur->categorisation }}
                                            </td> --}}
                                            <td style="white-space: normal !important;">{{ $fournisseur->nomGerant }}</td>
                                            <td style="white-space: normal !important;">{{ $fournisseur->statutJuridique }}</td>
                                            <td style="white-space: normal !important;">{{ $fournisseur->domaine }}</td>
                                            <td>{{ $fournisseur->telephone }}</td>
                                            <td style="white-space: normal !important;">{{ $fournisseur->adresse }}</td>
                                            {{-- <td>
                                                <div class="btn-group" role="group" aria-label="Action Frais">
                                                    <a href='{{ url("fournisseur/$fournisseur->id/update") }}'
                                                        class="btn btn-sm btn-warning">
                                                        <i class="ti-pencil-alt text-white"> Modifier</i>
                                                    </a>
                                                    <a href='{{ url("fournisseur/$fournisseur->id/delete") }}'
                                                        class="btn btn-sm btn-danger">
                                                        <i class="ti-trash text-white"> Supprimer</i>
                                                    </a>
                                                </div>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                @else
                                    <div class="alert alert-info text-center" alt="alert">
                                        Aucune entreprise existante
                                    </div>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{ $fournisseurs->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
@endsection
