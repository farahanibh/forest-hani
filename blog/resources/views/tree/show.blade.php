@extends('layouts.argon')
@section('content')

<div class="container-fluid py-4">
    <h3 class="text-center font-weight-bold text-light">{{ $tree->species->malay_name }} | {{ $tree->species->eng_name }}</h3>
      <div class="row">
        <div class="col-md-20">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="text-uppercase ">Tree Plot Information</p>
                <a class="btn btn-primary btn-sm ms-auto" href="{{ route('tree.index') }}"> Back</a>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Plot Name</label>
                    <input class="form-control text-uppercase" value="{{ $tree->plot->plot_name }}" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">DBH</label>
                    <input class="form-control" value="{{$tree -> dbh}}" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Scaling Factor</label>
                    <input class="form-control" type="text" value="{{$tree -> scalling_factor}}" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Wood Density</label>
                    <input class="form-control text-uppercase" type="text" value="{{$tree -> wood_density}}" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Size of Nest</label>
                    <input class="form-control" type="text" value="{{$tree -> size_nest}}" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Tree Density</label>
                    <input class="form-control" value="{{ $tree->scalling_factor2 }}" disabled>
                  </div>
                  </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Biomass (kg)</label>
                    <input class="form-control text-uppercase" value="{{ $tree->biomass }}" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Biomass (kg/Ha)</label>
                    <input class="form-control" value="{{$tree -> biomass2}}" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Basal Area (m2)</label>
                    <input class="form-control text-uppercase" value="{{ $tree->basal_area }}" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Basal Area (m2/Ha)</label>
                    <input class="form-control" value="{{$tree -> basal_area2}}" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Volume (m3)</label>
                    <input class="form-control text-uppercase" value="{{ $tree->volume }}" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Volume (m3/Ha)</label>
                    <input class="form-control" value="{{$tree -> volume2}}" disabled>
                  </div>
                </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

@endsection