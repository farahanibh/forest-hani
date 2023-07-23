@extends('layouts.argon')
@section('content')

<!DOCTYPE html>
<html>
  <head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
      $(document).ready(function() {
        $("select").select2();
      });
    </script>

    <style>

    
    .js-example-basic-single {
      width: 100%;
      height: 150px;
      font-size: 14px;
      line-height: 1.4rem;
      padding: 0 12px;
      border: 1px solid #d2d6da;
      border-radius: 0.5rem;
      color: #333;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
      top: 6px;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
      padding-left: 8px;
    }
    
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
      background-color: #ddd;
    }

    </style>
</head>

<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container-fluid py-4">
    <h3 class="text-center font-weight-bold text-light">NEW PLOT</h3>

    <form action="{{ route('plot.update',$plot->id) }}" method="POST" id="form">
        @csrf
        @method('PUT')
        
      <div class="row">
          <input type="hidden" name="id" value="{{ $plot->id }}"> <br/>
        <div class="col-md-20">
          <div class="card">
            <div class="card-body">
              <p class="text-uppercase ">Team Information</p>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Date Record</label>
                    <input class="form-control" type="date" name="date_record" value="{{$plot -> date_record}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Total Team</label>
                    <input class="form-control" type="number" min="1" name="total_team" value="{{$plot -> total_team}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Team Leader</label>
                    <input class="form-control text-uppercase" type="text" name="team_leader" value="{{$plot -> team_leader}}" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Record By</label>
                    <input class="form-control text-uppercase" type="text" name="record_by" value="{{$plot -> record_by}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Start Time</label>
                    <input class="form-control" type="time" name="start_time" value="{{$plot -> start_time}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">End Time</label>
                    <input class="form-control" type="time" name="end_time" value="{{$plot -> end_time}}">
                  </div>
                </div>
              </div>


              <hr class="horizontal dark">
              <p class="text-uppercase">Plot Information</p>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Plot Name</label>
                    <input class="form-control text-uppercase" type="text" name="plot_name" value="{{$plot -> plot_name}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Location</label>
                    <input class="form-control text-uppercase" type="text" name="location" id="location" value="{{$plot -> location}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Latitude</label>
                    <input class="form-control" type="number" placeholder="0.00000" step="0.00001" name="latitude" id="latitude" value="{{$plot -> latitude}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Longitude</label>
                    <input class="form-control" type="number" placeholder="000.00000" step="000.00001" name="longitude" id="longitude" value="{{$plot -> longitude}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Average Slope</label>
                    <input class="form-control" type="number" placeholder="00.00" step="00.0001" name="avg_slope" value="{{$plot -> avg_slope}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Strata Type</label>
                    <!--<input class="form-control text-uppercase" type="text" placeholder="ABC" name="strata_type">-->
                    <select class="js-example-basic-single form-control" name="strata_type" id="strata_type">
                      <option value="" selected >{{$plot -> strata_type}}</option>
                      <option value="Beach Forest">Beach Forest</option>
                      <option value="Mangrove Forest">Mangrove Forest</option>
                      <option value="Lowland Peat Swamp Forest">Lowland Peat Swamp Forest</option>
                      <option value="Lowland Freshwater Swamp Forest">Lowland Freshwater Swamp Forest</option>
                      <option value="Lowland Kerangas Forest">Lowland Kerangas Forest</option>
                      <option value="Lowland Ultramafic Forest">Lowland Ultramafic Forest</option>
                      <option value="Lowland Mixed Dipterocarp Forest">Lowland Mixed Dipterocarp Forest</option>
                      <option value="Lowland Mixed Dipterocarp & Kerangas Forest">Lowland Mixed Dipterocarp & Kerangas Forest</option>
                      <option value="Lowland Mixed Dipterocarp Forest & Limestone vegetation">Lowland Mixed Dipterocarp Forest & Limestone vegetation</option>
                      <option value="Lowland Seasonal Freshwater Swamp Forest">Lowland Seasonal Freshwater Swamp Forest</option>
                      <option value="Upland Peat Swamp Forest">Upland Peat Swamp Forest</option>
                      <option value="Upland Freshwater Swamp Forest">Upland Freshwater Swamp Forest</option>
                      <option value="Upland Kerangas Forest">Upland Kerangas Forest</option>
                      <option value="Upland Ultramafic Forest">Upland Ultramafic Forest</option>
                      <option value="Upland Mixed Dipterocarp Forest">Upland Mixed Dipterocarp Forest</option>
                      <option value="Upland Mixed Dipterocarp & Kerangas Forest">Upland Mixed Dipterocarp & Kerangas Forest</option>
                      <option value="Upland Mixed Dipterocarp Forest & Limestone vegetation">Upland Mixed Dipterocarp Forest & Limestone vegetation</option>
                      <option value="Lower Montane Peat Swamp Forest">Lower Montane Peat Swamp Forest</option>
                      <option value="Lower Montane Kerangas Forest">Lower Montane Kerangas Forest</option>
                      <option value="Lower Montane Forest">Lower Montane Forest</option>
                      <option value="Lower Montane Ultramafic Forest">Lower Montane Ultramafic Forest</option>
                      <option value="Upper Montane Ultramafic Forest">Upper Montane Ultramafic Forest</option>
                      <option value="Upper Montane Forest">Upper Montane Forest</option>
                      <option value="Sub Alpine Vegetation">Sub Alpine Vegetation</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">GPS Accuracy</label>
                    <input class="form-control" type="number" min="0" name="gps_accuracy" value="{{$plot -> gps_accuracy}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Resam</label>
                    <input class="form-control" type="number" min="0" name="resam" value="{{$plot -> resam}}"> 
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Typography</label>
                    <input class="form-control" type="number" min="0" name="typography" value="{{$plot -> typography}}"> 
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Elevation</label>
                    <input class="form-control" type="number" min="0" name="elevation" value="{{$plot -> elevation}}"> 
                  </div>
                </div>
              </div>
              
              <hr class="horizontal dark">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>    
                    <a class="btn btn-primary" href="{{ route('plot.index') }}"> Back</a>
                </div>
            </div>
          </div>
        </div>
      </div>
</form>
  </body>
  </html>
@endsection