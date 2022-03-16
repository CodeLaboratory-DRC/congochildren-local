@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-8 ps-0">
                                <h4 class="text-right my-7">
                                    @if ($type == 'fournisseur')
                                        Liste des entreprises locales fournisseurs des materiaux de construction dans la
                                        corbeille
                                    @else
                                        Liste des structure du secteur prive operationnelles dans l’agrobusiness dans la
                                        corbeille
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
                                    <th>Status juridique</th>
                                    <th>Domaine</th>
                                    <th>Téléphone</th>
                                    <th>adresse</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if ($fournisseurs->isNotEmpty())
                                    @foreach ($fournisseurs as $fournisseur)
                                        <tr>
                                            <td>{{ $fournisseur->id }}</td>
                                            <td>{{ $fournisseur->nom }}</td>
                                            <td>
                                                {{ $fournisseur->categorisation }}
                                            </td>
                                            <td>{{ $fournisseur->nomGerant }}</td>
                                            <td>{{ $fournisseur->statutJuridique }}</td>
                                            <td>{{ $fournisseur->domaine }}</td>
                                            <td>{{ $fournisseur->telephone }}</td>
                                            <td>{{ $fournisseur->adresse }}</td>
                                            {{-- <td>
                                                <div class="btn-group" role="group" aria-label="Action Frais">
                                                    <a href='{{ url("fournisseur/$fournisseur->id/restore") }}'
                                                        class="btn btn-sm btn-warning">
                                                        <i class="ti-back-left text-white"> Restorer</i>
                                                    </a>
                                                    <a href='{{ url("fournisseur/$fournisseur->id/remove") }}'
                                                        class="btn btn-sm btn-danger">
                                                        <i class="ti-close text-white"> Supprimer definitivement</i>
                                                    </a> 
                                                </div>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                @else
                                    <div class="alert alert-info text-center" alt="alert">
                                        Aucune entreprise disponible dans la corbeille
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
