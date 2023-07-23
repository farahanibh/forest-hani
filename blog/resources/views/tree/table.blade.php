@section('content')

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-light" href="{{ route('tree.create') }}"> Add New Tree</a>
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <div class="container">
      <form action="{{ url('filterByTree') }}" method="post">
                  @csrf

        <div class="wrapper">
          <p style="color:white">Filter</p>
          <div class="search-container">
          <input type="text" name="year" class="search form-control" placeholder="Search By Year">
            <input type="text" name="plot_name" class="search form-control" placeholder="Search By Plot">
            <input type="text" name="malay_name" class="search form-control" placeholder="Search By Tree">
            <input type="text" name="size_nest" class="search form-control" placeholder="Search By Size of Nest">
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
              <div class="d-flex align-items-center">
                <h6 class="text-uppercase ">List of Tree</h6>
                 <span></span><p class="text-uppercase text-danger text-m font-weight-bolder opacity-7">{{ $treeCount }}</p></span>
                <a class="btn btn-danger btn-sm ms-auto" onclick="location.href='{{ route('routeName') }}'"> Calculate</a>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2"> 
              <div class="table-responsive p-0">

                <table class="table align-items-center mb-0">
                   
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Plot ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Species</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DBH</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Scalling Factor <br> Wood Density</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Scalling Factor <br> Tree Density</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Biomass</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Volume</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Basal Area</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>                  
                  
                  @foreach ($tree as $p)
                  <tbody>
                  <tr>
                        <td class="text-secondary text-xs font-weight-bold">{{ $p-> plot -> plot_name }}</td>
                        <td class="text-secondary text-xs font-weight-bold">{{ $p-> species -> malay_name }} <br> {{ $p-> species -> eng_name }}</td>
                        <td class="text-secondary text-xs font-weight-bold">{{ $p->dbh}} <br> {{ $p->size_nest}}</td>
                        <td class="text-secondary text-xs font-weight-bold">{{ $p->scalling_factor }} <br> {{ $p->wood_density }}</td>
                        <td class="text-secondary text-xs font-weight-bold">{{ $p->scalling_factor2 }}</td>
                        
                        <td class="text-secondary text-xs font-weight-bold">
                            {{ $p->biomass }} kg <br>
                            {{ $p->biomass2 }} kg<sup>2</sup>/Ha
                        </td>
                        
                        <td class="text-secondary text-xs font-weight-bold">
                            {{ $p->volume }} m <br>
                            {{ $p->volume2 }} m<sup>2</sup>/Ha
                        </td>
                            
                        <td class="text-secondary text-xs font-weight-bold">
                            {{ $p->basal_area }} m <br>
                            {{ $p->basal_area2 }} m<sup>2</sup>/Ha
                        </td>

                        <td class="">
                            <form action="{{ route('tree.destroy',$p->id) }}" method="POST">            
                                <a class="btn" href="{{ route('tree.show',$p->id) }}"><i class="fa fa-eye"></i></a>
                                <a class="btn" href="{{ route('tree.edit',$p->id) }}"><i class="fa fa-edit"></i></a>
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



/* 

input {

  order: 0;
  flex: 1 1 auto;
  align-self: auto;
  display: flex;
  flex-direction: row;
  justify-content: flex-start;
  flex-wrap: nowrap;
  border: 1px solid #A9A9A9;
  border-radius: 3px;
  height: 50px;
  
}
 */

/* 
.flex-item:nth-child(1) {
    -webkit-order: 0;
    -ms-flex-order: 0;
    order: 0;
    -webkit-flex: 2 1 auto;
    -ms-flex: 2 1 auto;
    flex: 2 1 auto;
    -webkit-align-self: auto;
    -ms-flex-item-align: auto;
    align-self: auto;
    }

.flex-item:nth-child(2) {
    -webkit-order: 0;
    -ms-flex-order: 0;
    order: 0;
    -webkit-flex: 1 1 auto;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    -webkit-align-self: auto;
    -ms-flex-item-align: auto;
    align-self: auto;
    }

.flex-item:nth-child(3) {
    -webkit-order: 0;
    -ms-flex-order: 0;
    order: 0;
    -webkit-flex: 1 1 auto;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    -webkit-align-self: auto;
    -ms-flex-item-align: auto;
    align-self: auto;
    }

.flex-item:nth-child(4) {
    -webkit-order: 0;
    -ms-flex-order: 0;
    order: 0;
    -webkit-flex: 1 1 auto;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    -webkit-align-self: auto;
    -ms-flex-item-align: auto;
    align-self: auto;
    }
 */
  </style>
@endsection