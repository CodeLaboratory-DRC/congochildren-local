@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-8 ps-0">
                                <h4 class="text-right my-7">Liste des ménages</h4>
                                <p class="card-description">
                                    regroupement des enfants et parents en famille
                                </p>
                            </div>
                            <div class="col-lg-2 pr-0">
                                <div class="btn-group" role="group" aria-label="Action Frais">
                                    <a href="{{ route('menage.print') }}" class="btn btn-sm btn-primary">
                                        <i class="ti-printer btn-icon-append"> imprimer la liste</i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-2 pr-0">
                                <div class="btn-group" role="group" aria-label="Action Frais">
                                    <a href="{{ route('menage.export') }}" class="btn btn-sm btn-success">
                                        <i class="ti-printer btn-icon-append"> exporter vers excel</i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom du Pere</th>
                                    <th>Nom de la mere</th>
                                    <th>Etat matrimonial</th>
                                    <th>Nombre d'enfants</th>
                                    <th>Identificateur</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($families->isNotEmpty())
                                    <?php $i = 0; ?>
                                    @foreach ($families->unique('nom_mere') as $family)
                                        <tr>
                                            <td>0115{{ $family->id }}</td>
                                            <td>{{ $family->nom_pere }}</td>
                                            <td>{{ $family->nom_mere }}</td>
                                            <td>{{ $family->matrimonial }}</td>
                                            <td>{{ $family->nb_enfant }}</td>

                                            <td>
                                                {{ App\Models\User::getName($family->user_id); }}
                                            </td>

                                            <td>
                                                <div class="btn-group" role="group" aria-label="Action Frais">
                                                    <a href='{{ url("menages/$family->id") }}'
                                                        class="btn btn-sm btn-primary">
                                                        <i class="ti-file">Accèder aux Détails</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <div class="alert alert-info text-center" alt="alert">
                                        Aucun enfant existant
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
