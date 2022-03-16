@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-8 ps-0">
                                <h4 class="text-right my-7">Détail de la coopérative agricole {{ $agricole->nom }} </h4>
                                <p class="card-description">
                                    Détail de la coopérative agricole
                                </p>
                            </div>
                            {{-- <div class="col-lg-2 pr-0">
                            <div class="btn-group" role="group" aria-label="Action Frais">
                              <a href="{{ route ('agricole.print')}}" class="btn btn-sm btn-primary">
                                <i class="ti-printer btn-icon-append"> imprimer la fiche</i>                                                                              
                              </a>
                            </div>
                          </div> --}}
                        </div>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive pt-3">
                                <p> <b> Informations globales</b></p> <br>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $agricole->agricole_id }}</td>
                                            <td>{{ $agricole->nom }}</td>
                                            <td>{{ $agricole->categorisation }}</td>
                                            <td>{{ $agricole->nomGerant }}</td>
                                            <td>{{ $agricole->serviceAgrement }}</td>
                                            <td>{{ $agricole->domaine }}</td>
                                            <td>{{ $agricole->capaciteProduction }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="table-responsive pt-3">
                                <p> <b> Informations de contact</b></p> <br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Adresse</th>
                                            <th>Téléphone</th>
                                            <th>Site web</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $agricole->agricole_id }}</td>
                                            <td>{{ $agricole->adresse }}</td>
                                            <td>
                                                {{ $agricole->telephone }}
                                            </td>
                                            <td>{{ $agricole->website }}</td>
                                            <td>{{ $agricole->email }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if ( Str::lower($agricole->domaine) == 'transformation des produits agricoles')                            
                          <div class="col-md-6">
                              <div class="table-responsive pt-3">
                                  <p> <b> Informations de transformation</b></p> <br>
                                  <table class="table table-bordered">
                                      <thead>
                                          <tr>
                                              <th>#</th>
                                              <th>Équipements de production</th>
                                              <th>Transformation</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td>{{ $agricole->agricole_id }}</td>
                                              <td>{{ $agricole->equipement }}</td>
                                              <td>{{ $agricole->transformation }}</td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
