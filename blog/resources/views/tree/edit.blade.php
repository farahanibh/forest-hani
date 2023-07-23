@extends('layouts.argon')
@section('content')

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

<form action="{{ route('tree.update', $tree->id) }}" method="POST">
    @csrf
    @method('PUT')

<div class="container-fluid py-4">
    <h3 class="text-center font-weight-bold text-light">{{ $tree->species->malay_name }} | {{ $tree->species->eng_name }}</h3>
      <div class="row">
        <div class="col-md-10 mx-auto">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-8 mx-auto">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Plot Name</label>
                    <select class="form-control" name="plot_id">
                        <option value="">-- Choose Plot --</option>
                        @foreach ($plot as $id => $plot_name)
                            <option
                                value="{{$id}}" {{ (isset($tree['plot_id']) && $tree['plot_id'] == $id) ? ' selected' : '' }}>{{$plot_name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-md-8 mx-auto">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Choose Species</label>
                    <select class="form-control" name="species_id">
                        <option value="">-- Choose Species --</option>
                        @foreach ($species as $id => $malay_name)
                            <option
                                value="{{$id}}" {{ (isset($tree['species_id']) && $tree['species_id'] == $id) ? ' selected' : '' }}>{{$malay_name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-md-8 mx-auto">
                  <div class="form-group">
                  <label for="example-text-input" class="form-control-label">DBH</label>
                    <input class="form-control" type="number" min="1" name="dbh" step="00.01" value={{$tree->dbh}}>
                  </div>
                </div>

                <div class="col-md-8 mx-auto">
                  <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Scalling Factor</label>
                    <input class="form-control" type="number" name="scalling_factor" value="10000">
                  </div>
                </div>

                <div class="col-md-8 mx-auto">
                  <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Wood Density</label>
                    <input class="form-control" type="number" name="wood_density" value="0.6" step="0.01">
                  </div>
                </div>
              </div>

              <hr class="horizontal dark">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>    
                    <a class="btn btn-primary" href="{{ route('tree.index') }}"> Back</a>
                </div>
            </div>
          </div>
        </div>
      </div>
</form>

@endsection