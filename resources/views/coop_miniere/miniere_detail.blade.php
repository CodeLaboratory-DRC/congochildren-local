@extends('templates.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="container-fluid d-flex justify-content-between">
                          <div class="col-lg-8 ps-0">
                            <h4 class="text-right my-7">Détails de la coopérative minière {{ $mine->nom }}</h4>
                            <p class="card-description">
                                détail de la coopérative minière
                            </p>
                          </div>
                          {{--<div class="col-lg-2 pr-0">
                            <div class="btn-group" role="group" aria-label="Action Frais">
                              <a href="{{ route ('mine.print')}}" class="btn btn-sm btn-primary">
                                <i class="ti-printer btn-icon-append"> imprimer</i>                                                                              
                              </a>
                            </div>
                          </div>
                          <div class="col-lg-2 pr-0">
                            <div class="btn-group" role="group" aria-label="Action Frais">
                              <a href="{{ route ('mine.export')}}" class="btn btn-sm btn-success">
                                <i class="ti-printer btn-icon-append"> exporter vers excel</i>                                                                              
                              </a>
                            </div>
                          </div>--}}
                        </div>
                        <hr>
                    </div>
                    <div class="table-responsive pt-3">
                      <p> <b>Informations globales</b> </p> <br>
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
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $mine->miniere_id }}</td>
                                    <td>{{ $mine->nom }}</td>
                                    <td>
                                      {{ $mine->categorisation }}
                                    </td>
                                    <td>{{ $mine->nomGerant }}</td>
                                    <td>{{ $mine->serviceAgrement }}</td>
                                    <td>{{ $mine->domaine }}</td>
                                    <td>{{ $mine->autreDomaines }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

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
                                  <td>{{ $mine->miniere_id }}</td>
                                  <td>{{ $mine->adresse }}</td>
                                  <td>
                                    {{ $mine->telephone }}
                                  </td>
                                  <td>{{ $mine->website }}</td>
                                  <td>{{ $mine->email }}</td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
