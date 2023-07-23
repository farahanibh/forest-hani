@extends('layouts.argon')
@section('content')

<div class="container-fluid py-4">
    <h3 class="text-center font-weight-bold text-light">{{$plot -> plot_name}}</h3>
      <div class="row">
        <div class="col-md-20">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="text-uppercase ">Team Information</p>
                <a class="btn btn-primary btn-sm ms-auto" href="{{ route('plot.index') }}"> Back</a>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Date Record</label>
                    <input class="form-control" type="date" value="{{$plot -> date_record}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Total Team</label>
                    <input class="form-control" type="number" value="{{$plot -> total_team}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Team Leader</label>
                    <input class="form-control text-uppercase" type="text" value="{{$plot -> team_leader}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Record By</label>
                    <input class="form-control text-uppercase" type="text" value="{{$plot -> record_by}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Start Time</label>
                    <input class="form-control" type="time" value="{{$plot -> start_time}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">End Time</label>
                    <input class="form-control" type="time" value="{{$plot -> end_time}}">
                  </div>
                </div>
              </div>


              <hr class="horizontal dark">
              <p class="text-uppercase">Plot Information</p>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Plot Name</label>
                    <input class="form-control text-uppercase" type="text" value="{{$plot -> plot_name}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Location</label>
                    <input class="form-control text-uppercase" type="text" value="{{$plot -> location}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Latitude</label>
                    <input class="form-control" type="number" value="{{$plot -> latitude}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Longitude</label>
                    <input class="form-control" type="number" value="{{$plot -> longitude}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Average Slope</label>
                    <input class="form-control" type="number" value="{{$plot -> avg_slope}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Strata Type</label>
                    <input class="form-control text-uppercase" type="text" value="{{$plot -> strata_type}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">GPS Accuracy</label>
                    <input class="form-control" type="number" value="{{$plot -> gps_accuracy}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Resam</label>
                    <input class="form-control" type="number" value="{{$plot -> resam}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Typography</label>
                    <input class="form-control" type="number" value="{{$plot -> typography}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Elevation</label>
                    <input class="form-control" type="number" value="{{$plot -> elevation}}">
                  </div>
                </div>
              </div>


              <hr class="horizontal dark">
              <p class="text-uppercase">Tree Information</p>

              <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">

                <table class="table align-items-center mb-0">
                    
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tree</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DBH</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Size of Nest</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Scalling Factor</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Wood Density</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Scalling Factor</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Biomass(kg)</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Biomass(kg/Ha)</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Volume(m3)</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Volume(m3/Ha)</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Basal Area(m2)</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Basal Area(m2/Ha)</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Density Tree</th>
                    </tr>
                  </thead>                  
       
                  <tbody>
                  @foreach ($trees as $tree)
                  <tr>
                        <td class="text-secondary text-xs font-weight-bold">
                          {{ $species->find($tree->species_id)->malay_name }} <br>
                          {{ $species->find($tree->species_id)->eng_name }}
                        </td>
                        <td class="text-secondary text-xs font-weight-bold">{{ $tree->dbh }}</td>
                        <td class="text-secondary text-xs font-weight-bold">{{ $tree->size_nest }}</td>
                        <td class="text-secondary text-xs font-weight-bold">{{ $tree->scalling_factor }}</td>
                        <td class="text-secondary text-xs font-weight-bold">{{ $tree->wood_density }}</td>
                        <td class="text-secondary text-xs font-weight-bold">{{ $tree->scalling_factor2 }}</td>
                        <td class="text-secondary text-xs font-weight-bold">{{ $tree->biomass }}</td>
                        <td class="text-secondary text-xs font-weight-bold">{{ $tree->biomass2 }}</td>
                        <td class="text-secondary text-xs font-weight-bold">{{ $tree->volume }}</td>
                        <td class="text-secondary text-xs font-weight-bold">{{ $tree->volume2 }}</td>
                        <td class="text-secondary text-xs font-weight-bold">{{ $tree->basal_area }}</td>
                        <td class="text-secondary text-xs font-weight-bold">{{ $tree->basal_area2 }}</td>
                        <td class="text-secondary text-xs font-weight-bold">{{ $tree->density_tree }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

              <hr class="horizontal dark">
              
              <div class="row">
              @foreach ($graphs as $graph)
                <div class="col-md-10">
                  <table>
                    <tr>
                      <th>Stand Density  </th>
                      <td>{{ $graph->tph }}</td>
                    </tr>
                    <tr>
                      <th>Timber Volume</th>
                      <td>{{ $graph->vop }}</td>
                    </tr>
                    <tr>
                      <th>Basal Area</th>     
                      <td>{{ $graph->bap }}</td>
                      </tr>
                    
                  </table>
                </div>
              </div>
              @endforeach
            </div>

            </div>
          </div>
        </div>
      </div>
    </div>

@endsection