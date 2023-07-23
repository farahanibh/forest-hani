<?php
//print_r ($datasets);
//die();
?> 

@extends('layouts.argon')

@section('content') 

    <html>
    <head>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    </head>\
    
    <body>
        <!--<h4 class="center"> Timber Volume</h4>-->
        <div class="row mt-4">
            <div class="col-lg-15 mb-lg-0 mb-4">
              <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                  <h6 class="text-capitalize">Timber Volume</h6>
                  <p class="text-sm mb-0">
                    <!--<i class="fa fa-arrow-up text-success"></i>
                    <span class="font-weight-bold">4% more</span> in 2021-->
                  </p>
                </div>
                <div class="card-body p-3">


                    <!--Average vop for each location-->
                    <div style="width:100%;">
                         <canvas id="vop-chart"  class="chart-canvas"></canvas>
                    </div>

                    <script>
                        // Get the average vop data from the query
                        var data = {!! $averages !!};
                    
                        // Extract the location and average_vop values into separate arrays
                        var locations = data.map(function(item) { return item.location; });
                        var vopValues = data.map(function(item) { return item.average_vop; });
                    
                        // Set up the chart options
                        var options = {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        };
                    
                        // Create a random color generator function
                        function getRandomColor() {
                            var letters = '0123456789ABCDEF';
                            var color = '#';
                            for (var i = 0; i < 6; i++) {
                                color += letters[Math.floor(Math.random() * 16)];
                            }
                            return color;
                        }
                    
                        // Create the chart
                        var ctx = document.getElementById('vop-chart').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: locations,
                                datasets: [{
                                    label: 'Timber Volume Each Location',
                                    data: vopValues,
                                    backgroundColor: data.map(function() { return getRandomColor(); }),
                                    borderColor: 'black',
                                    borderWidth: 1
                                }]
                            },
                            options: options
                        });
                    </script>
 
 <br><br>
 
                  <!--vop for each cluster-->
                    <div class="chart">
                        <?php $counter = 1; ?>
                    @foreach ($datasets as $location => $locationData)
                        @foreach ($locationData as $dateRecord => $dateRecordData)
                            <div style="width:100%;">
                                <canvas id="{{ $location . $dateRecord }}" class="chart-canvas"></canvas>
                            </div>
                            <script>
                                var ctx = document.getElementById("{{ $location . $dateRecord }}").getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: [
                                            @foreach ($dateRecordData as $data)
                                                "{{ $data['plot_name'] }}",
                                            @endforeach
                                        ],
                                        datasets: [{
                                            label: "{{ $location }} - {{ $dateRecord }}",
                                            data: [
                                                @foreach ($dateRecordData as $data)
                                                    {{ $data['vop'] }},
                                                @endforeach
                                            ],
                                            backgroundColor: [
                                                @foreach ($dateRecordData as $data)
                                                    'rgba(' + Math.floor(Math.random() *256) + ', ' + Math.floor(Math.random() * 256) + ', ' + Math.floor(Math.random() * 256) + ', 0.8)',
                                                @endforeach
                                            ],
                                            borderColor: [
                                                @foreach ($dateRecordData as $data)
                                                    "black",
                                                @endforeach
                                            ],
                                            borderWidth: 0.5
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    beginAtZero: true
                                                }
                                            }]
                                        }
                                    }
                                });
                            </script>
                            <br><br>
                        @endforeach
                    @endforeach
                    
                    
                    </div>

                </div>
              </div>
            </div>
        </div>
    </body>
</html>


@endsection