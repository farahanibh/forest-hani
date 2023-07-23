@extends('layouts.argon')

@section('content') 
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.3/leaflet.css" type="text/css" crossorigin="">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.3/leaflet.js" crossorigin=""></script>
    <style>
    </style>
</head>
<body>
<div class="row mt-4">
    <div class="col-lg-9 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
          <div class="card-header pb-0 pt-3 bg-transparent">
            <h6 class="text-capitalize">Map</h6>
          </div>
          <div class="card-body p-3">
            <div id='map' style='width: 700px; height: 500px;'></div>

        @push('scripts')
            <script>
                // load map
                mapboxgl.accessToken = 'pk.eyJ1IjoibnJmaGFuaSIsImEiOiJjbGJtNm53bzUwZWltM3Zvc3N0enk2bzk5In0.nENAuNILtHkChu3Im2lILA';
                var map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/mapbox/outdoors-v12',
                    center: [101.9758, 4.2105],
                    zoom: 15,
                });

                // fence the map to Malaysia
                map.on('load', function() {
                    map.fitBounds([[100.1159668, 6.1421916], [119.1804199, 4.4758663]]); //Malaysia

                    map.addLayer(
                        {
                        id: 'country-boundaries',
                        source: {
                            type: 'vector',
                            url: 'mapbox://mapbox.country-boundaries-v1',
                        },
                        'source-layer': 'country_boundaries',
                        type: 'fill',
                        paint: {
                            'fill-color': '#d2361e',
                            'fill-opacity': 0.4,
                        },
                        },
                        'country-label'
                    );

                    map.setFilter('country-boundaries', [
                        "in",
                        "iso_3166_1_alpha_3",
                        'MYS'
                    ]);
                });

                var markers = [];
                @foreach ($maps as $key => $map)
                    @if ($map)
                        var marker = new mapboxgl.Marker()
                        .setLngLat([{{ $map['longitude'] }}, {{ $map['latitude'] }}])                 
                        markers.push(marker);       
                        
                        var popup = new mapboxgl.Popup()
                        .setHTML(`
                            <h5>{{ $map['plot_name'] }}</h5>
                            <p>{{ $map['latitude'] }}</p>
                            <p>{{ $map['longitude'] }}</p>
                        `)

                        marker.setPopup(popup);

                        marker.getElement().addEventListener('click', function() {
                        document.getElementById('plotName').value = '{{ $map['plot_name'] }}';
                        document.getElementById('latitude').value = '{{ $map['latitude'] }}';
                        document.getElementById('longitude').value = '{{ $map['longitude'] }}';
                        document.getElementById('location').value = '{{ $map['location'] }}';
                        document.getElementById('team_leader').value = '{{ $map['team_leader'] }}';
                        document.getElementById('avg_slope').value = '{{ $map['avg_slope'] }}';
                        /*
                        document.getElementById('strata_type').value = '{{ $map['strata_type'] }}';
                        document.getElementById('resam').value = '{{ $map['resam'] }}';
                        document.getElementById('typography').value = '{{ $map['typography'] }}';
                        document.getElementById('elevation').value = '{{ $map['elevation'] }}';*/
                        document.getElementById('formContainer').style.display = 'block';
                    });
                    @endif
                @endforeach

                markers.forEach(function(marker) {
                    marker.addTo(map);
                });
            </script>                                
        @endpush 
          </div>
    </div>
</div>

        <div class="col-lg-3">
          <div class="card card-carousel overflow-hidden h-100 p-0">
          <div class="card-header pb-0 pt-3 bg-transparent">
            <h6 class="text-capitalize">Plot Information</h6>
            <p class="text-sm mb-0">
              <i class="fa fa-map-marker"></i>
              <span class="font-weight-bold">Click the marker for detail information</span> 
            </p>
          </div>
          <br>
            <div id="formContainer" style="display: none;">
            <table class="center>
            <form>
            <tr>
                <div class="col-md-6">
                    <div class="form-group">
                        <td><label class="form-control-label" for="plotName">Plot Name:</label></td>
                        <td><input type="text" class="form-control" id="plotName" readonly></td>
                    </div>
                </div>
            </tr>
            <tr>
                <div class="col-md-6">
                    <div class="form-group">
                        <td><label class="form-control-label" for="latitude">Latitude:</label></td>
                        <td><input type="text" class="form-control" id="latitude" readonly></td>
                    </div>
                </div>
            </tr>
            <tr>
                <div class="form-group">
                    <td><label class="form-control-label" for="longitude">Longitude:</label></td>
                    <td><input type="text" class="form-control" id="longitude" readonly></td>
                </div>
            </tr>
            <tr>
                <div class="form-group">
                    <td><label class="form-control-label" for="location">location:</label></td>
                    <td><input type="text" class="form-control" id="location" readonly></td>
                </div>
            </tr>
            <tr>
                <div class="form-group">
                    <td><label class="form-control-label" for="team_leader">Team Leader:</label></td>
                    <td><input type="text" class="form-control" id="team_leader" readonly></td>
                </div>
            </tr>
            <tr>
                <div class="form-group">
                    <td><label class="form-control-label" for="avg_slope">Average Slope:</label></td>
                    <td><input type="text" class="form-control" id="avg_slope" readonly></td>
                </div>
            </tr>

            </form>
            </table>
            </div>  
          </div>
        </div>
</div>
  

</body>
</html>
@endsection