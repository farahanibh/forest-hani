@section('content')

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-light" href="{{ route('species.create') }}"> Add New Species</a>
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="container">
      <form action="{{ url('filterBySpecies') }}" method="post">
                  @csrf

        <div class="wrapper">
          <p style="color:white">Filter</p>
          <div class="search-container">
            <input type="text" name="malay_name" class="search form-control" placeholder="Search by Malay Name">
            <input type="text" name="eng_name" class="search form-control" placeholder="Search by English Name">
            <button type="submit" class="btn btn-light"><i class="fas fa-search"></i></button>
          </div>
        </div>
      </form>
    </div>
    
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>List of Species</h6>
              
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">English Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Malay Name</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>                  
                  
                  @foreach ($species as $p)
                  <tbody>
                  <tr>
                        <td class="text-secondary text-s font-weight-medium">{{ $p->eng_name }}</td>
                        <td class="text-secondary text-s font-weight-medium">{{ $p->malay_name}}</td>
                        <td class="">
                            <form action="{{ route('species.destroy',$p->id) }}" method="POST">            
                                <a class="btn" href="{{ route('species.show',$p->id) }}"><i class="fa fa-eye"></i></a>
                                <a class="btn" href="{{ route('species.edit',$p->id) }}"><i class="fa fa-edit"></i></a>
                                    @csrf
                                    @method('DELETE')
                                <button type="submit" class="btn"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
<style>
.search-container {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  justify-content: flex-start;
  align-content: stretch;
  align-items: flex-start;
}

input {
  min-width: 20px;
  padding: 8px;
  margin: 0 4px 0 0;
  border: 1px solid #666;
  border-radius: 5px;
  height: 30px;
}

.button {
  padding: 8px 16px;
  min-height: 48px;
  min-width: 10px;
  word-wrap: nowrap;
  background: #000;
  color: #fff;
  border: 1px solid #fff;
  border-radius: 5px;
}

input {
    order: 0;
    align-self: auto;  
}

.search {
  flex: 2 1 auto;
}
  </style>
@endsection

