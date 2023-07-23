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

<form action="{{ route('species.store') }}" method="POST">
    @csrf
<div class="container-fluid py-4">
    <h3 class="text-center font-weight-bold text-light">NEW SPECIES</h3>
      <div class="row">
        <div class="col-md-10 mx-auto">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-8 mx-auto">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">English Name</label>
                    <input class="form-control" type="text" name="eng_name" placeholder="ABC">
                  </div>
                </div>
                <div class="col-md-8 mx-auto">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Malay Name</label>
                    <input class="form-control" type="text" name="malay_name" placeholder="ABC">
                  </div>
                </div>
                
              </div>
              
              <hr class="horizontal dark">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>    
                    <a class="btn btn-primary" href="{{ route('species.index') }}"> Back</a>
                </div>
            </div>
          </div>
        </div>
      </div>
</form>
@endsection