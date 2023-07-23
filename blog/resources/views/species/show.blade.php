@extends('layouts.argon')
@section('content')

<div class="container-fluid py-4">
    
      <div class="row">
        <div class="col-md-10 mx-auto">
          <div class="card">
            <div class="card-body">
                <h3 class="font-weight-bold text-dark text-uppercase">Species: {{$species->eng_name}}</h3>
              <div class="row">
                <div class="col-md-8 mx-auto">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">English Name</label>
                    <input class="form-control text-uppercase font-weight-bold" type="text" name="eng_name" value={{$species->eng_name}}>
                  </div>
                </div>
                <div class="col-md-8 mx-auto">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Malay Name</label>
                    <input class="form-control text-uppercase font-weight-bold" type="text" name="malay_name" value={{$species->malay_name}}>
                  </div>
                </div>
              </div>
              
              <hr class="horizontal dark">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">  
                    <a class="btn btn-primary" href="{{ route('species.index') }}"> Back</a>
                </div>
            </div>
          </div>
        </div>
      </div>
@endsection