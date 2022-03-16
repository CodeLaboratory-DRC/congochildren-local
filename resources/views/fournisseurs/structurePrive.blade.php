@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="container-fluid d-flex justify-content-between">
                          <div class="col-lg-8 ps-0">
                            <h4 class="text-right my-7">Liste des structures privées oeuvrant dans l'agrobusiness </h4>
                            <p class="card-description">
                                Liste des structures privées oeuvrant dans l'agrobusiness 
                            </p>
                          </div>
                          <div class="col-lg-2 pr-0">
                            <div class="btn-group" role="group" aria-label="Action Frais">
                              <a href="{{ route ('agrobusinesse.print')}}" class="btn btn-sm btn-primary">
                                <i class="ti-printer btn-icon-append"> imprimer la liste</i>                                                                              
                              </a>
                            </div>
                          </div>
                          <div class="col-lg-2 pr-0">
                            <div class="btn-group" role="group" aria-label="Action Frais">
                              <a href="{{ route ('agrobusinesse.export')}}" class="btn btn-sm btn-success">
                                <i class="ti-printer btn-icon-append"> exporter vers excel</i>                                                                              
                              </a>
                            </div>
                          </div>
                        </div>
                        <hr>
                    </div>

                    @if (Str::lower($agrobusinesse->categorisation) == 'agrobusiness')
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="white-space: normal !important;">Nom</th>
                                        <th>Catégorisation</th>
                                        <th style="white-space: normal !important;">Gérant</th>
                                        <th style="white-space: normal !important;">Status juridique</th>
                                        <th style="white-space: normal !important;">Domaine</th>
                                        <th>Téléphone</th>
                                        <th style="white-space: normal !important;">adresse</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($agrobusinesses->isNotEmpty())
                                        @foreach ($agrobusinesses->unique('nom') as $agrobusinesse)
                                            <tr>
                                                <td>{{ $agrobusinesse->id }}</td>
                                                <td>{{ $agrobusinesse->nom }}</td>
                                                <td>
                                                    {{ $agrobusinesse->categorisation }}
                                                </td>
                                                <td>{{ $agrobusinesse->nomGerant }}</td>
                                                <td>{{ $agrobusinesse->statutJuridique }}</td>
                                                <td>{{ $agrobusinesse->domaine }}</td>
                                                <td>{{ $agrobusinesse->telephone }}</td>
                                                <td>{{ $agrobusinesse->adresse }}</td>
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
                        {{ $agrobusinesses->links('vendor.pagination.custom') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
