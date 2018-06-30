{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    @foreach($topos as $topo)
        <url>
            @foreach($languages as $language)
                @if($loop->first)
                    <loc>{{ $app }}/{{$language}}{{route('topoPage', ['topo_label'=> str_slug($topo->label), 'topo_id'=>$topo->id], false)}}</loc>
                @else
                    <xhtml:link rel="alternate" hreflang="{{ $app }}/{{$language}}{{route('topoPage', ['topo_label'=> str_slug($topo->label), 'topo_id'=>$topo->id], false)}}" />
                @endif
            @endforeach
            <lastmod>{{ $topo->updated_at ? $topo->updated_at->format('Y-m-d') : $topo->created_at->format('Y-m-d') }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
            @if(file_exists(storage_path('app/public/topos/700/topo-' . $topo->id . '.jpg')))
                <image:image>
                    <image:loc>{{ $app }}/storage/topos/700/topo-{{ $topo->id }}.jpg</image:loc>
                </image:image>
            @endif
        </url>
    @endforeach
</urlset>