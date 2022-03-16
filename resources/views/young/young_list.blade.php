@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-6 ps-0">
                                <h4 class="text-right my-7">Liste des jeunes</h4>
                                <p class="card-description">
                                    liste des jeunes travaillant sur tous les sites
                                </p>
                            </div>
                            <div class="col-lg-6 pr-0">
                                <div class="btn-group" role="group" aria-label="Action Frais">
                                    <a href="{{ route('young.bin') }}" class="btn btn-sm btn-info">
                                        <i class="ti-eye btn-icon-append"></i>
                                        <i class="ti-trash btn-icon-append text-white"> Corbeille</i>
                                    </a>
                                </div>
                                @if ($youngers->isNotEmpty())
                                    <div class="btn-group" role="group" aria-label="Action Frais">
                                        <a href="{{ route('younger.print') }}" class="btn btn-sm btn-primary">
                                            <i class="ti-printer btn-icon-append"> imprimer la liste</i>
                                        </a>
                                    </div>
                                    <div class="btn-group" role="group" aria-label="Action Frais">
                                        <a href="{{ route('younger.export') }}" class="btn btn-sm btn-success">
                                            <i class="ti-printer btn-icon-append"> exporter vers excel</i>
                                        </a>
                                    </div>
                                @endif
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
                        @if (session('error'))
                            <div class="alert alert-error text-center msg" id="error">
                                <strong>{{ session('error') }}</strong>
                            </div>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Age</th>
                                    <th>Genre</th>
                                    <th>Identificateur</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($youngers->isNotEmpty())
                                    @foreach ($youngers as $younger)
                                        <tr>
                                            <td>0114{{ $younger->id }}</td>
                                            <td  style="white-space: normal !important;">{{ $younger->nom }}</td>
                                            <td>{{ $younger->age }}ans</td>
                                            <td>{{ $younger->genre == 'm' ? 'Masculin' : 'Feminin' }}</td>
                                            <td>
                                                {{ App\Models\User::getName($younger->user_id) }}
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Action Frais">
                                                    <a href='{{ url("young/$younger->id/fiche") }}'
                                                        class="btn btn-sm btn-primary">
                                                        <i class="ti-file">Détails</i>
                                                    </a>
                                                    {{-- <a href='{{ url("young/$younger->id/update") }}'
                                                        class="btn btn-sm btn-warning">
                                                        <i class="ti-pencil-alt text-white"> Modifier</i>
                                                    </a>
                                                    <a href='{{ url("young/$younger->id/delete") }}'
                                                        class="btn btn-sm btn-danger">
                                                        <i class="ti-trash text-white"> Supprimer</i>
                                                    </a> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <div class="alert alert-info text-center" alt="alert">
                                        Aucun jeune existant
                                    </div>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{ $youngers->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
@endsection
