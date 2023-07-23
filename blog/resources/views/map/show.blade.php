<h1>{{ $plot->plot_name }}</h1>
<p>Latitude: {{ $plot->latitude }}</p>
<p>Longitude: {{ $plot->longitude }}</p>

<h2>Trees</h2>
<ul>
    @foreach ($plot->trees as $tree)
        <li>{{ $tree->species->malay_name }} - DBH: {{ $tree->dbh }}, Size Nest: {{ $tree->size_nest }}, Biomass: {{ $tree->biomass }}, Volume: {{ $tree->volume }}</li>
    @endforeach
</ul>

<h2>Graph</h2>
<p>TPH: {{ $plot->graph->tph }}, BAP: {{ $plot->graph->bap }}, VOP: {{ $plot->graph->vop }}</p>
