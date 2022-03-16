@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-6 ps-0">
                                <h4 class="text-right my-7">Liste des enfants dans la corbeille</h4>
                                <p class="card-description">
                                    liste des enfants travaillant sur tous les sites
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
                                    <th>Age</th>
                                    <th>Genre</th>
                                    <th>Identificateur</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($children->isNotEmpty())
                                    @foreach ($children as $child)
                                        <tr>
                                            <td>0114{{ $child->id }}</td>
                                            <td>{{ $child->nom }}</td>
                                            <td>{{ $child->age }}ans</td>
                                            <td>{{ $child->genre == 'm' ? 'Masculin' : 'Feminin' }}</td>
                                            <td>
                                                {{ App\Models\User::getName($child->user_id) }}
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Action enfant">
                                                    <a href='{{ url("children/$child->id/restore") }}'
                                                        class="btn btn-sm btn-warning">
                                                        <i class="ti-back-left text-white"> Restorer</i>
                                                    </a>
                                                    <a href='{{ url("children/$child->id/remove") }}'
                                                        class="btn btn-sm btn-danger">
                                                        <i class="ti-close text-white"> Supprimer definitivement</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <div class="alert alert-info text-center" alt="alert">
                                        Aucun enfant dans la corbeille
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
