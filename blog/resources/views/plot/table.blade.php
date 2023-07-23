@section('content')

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-light" href="{{ route('plot.create') }}"> Add New Plot</a>
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="container">
      <form action="{{ url('filterByYear') }}" method="post">
                  @csrf

        <div class="wrapper">
          <p style="color:white">Filter</p>
          <div class="search-container">
            <input type="text" name="year" class="search form-control" placeholder="Search By Year">
            <input type="text" name="location" class="search form-control" placeholder="Search By Location">
            <input type="text" name="strata_type" class="search form-control" placeholder="Search By Strata Type">
            <input type="text" name="plot_name" class="search form-control" placeholder="Search of Plot Name">
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
              <h6>List of Plots</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">

                <table class=" table align-items-center mb-0">
                    
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Team Details</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Location</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Details</th>

                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>                  
                  
                  @foreach ($plot as $p)
                  <tbody>
                  <tr>
                        <td class="text-secondary text-xs font-weight-bold">
                            {{ $p->plot_name }} <br>
                            Date: {{ $p->date_record }}
                        </td>
                        <td class="text-secondary text-xs font-weight-bold">
                            {{ $p->team_leader }} <br>
                            No. of Team: {{ $p->total_team }}
                        </td>
                        
                        <td class="text-secondary text-xs font-weight-bold">
                            {{ $p->location}} <br>
                            ({{ $p->latitude }} , {{ $p->longitude }})
                        </td>

                        <td class="text-secondary text-xs font-weight-bold">
                            <table class="table table-borderless">
                                <tr>
                                    <td>Strata Type </td> 
                                    <td> : </td>
                                    <td>{{ $p->strata_type }} </td>
                                </tr>
                                <tr>
                                    <td>Avg Slope </td>
                                    <td> : </td>
                                    <td>{{ $p->avg_slope }} </td>
                                </tr>
                                <tr>
                                    <td>Accuracy </td>
                                    <td> : </td>
                                    <td>{{ $p->gps_accuracy }}</td>
                                    </tr>
                                <tr>
                                    <td>Resam </td>
                                    <td> : </td>
                                    <td>{{ $p->resam }} </td>
                                </tr>
                                <tr>
                                    <td>Typography </td>
                                    <td> : </td>
                                    <td>{{ $p->typography }} </td>
                                </tr>
                                <tr>
                                    <td>Elevation </td>
                                    <td> : </td>
                                    <td>{{ $p->elevation }} </td>
                                </tr>
 
                            </table>

                        </td>

                        <td class="">
                            <form action="{{ route('plot.destroy',$p->id) }}" method="POST">            
                                <a class="btn" href="{{ route('plot.show',$p->id) }}"><i class="fa fa-eye"></i></a>
                                <a class="btn" href="{{ route('plot.edit',$p->id) }}"><i class="fa fa-edit"></i></a>
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