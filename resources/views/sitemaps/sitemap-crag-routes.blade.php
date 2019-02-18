{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">

    <url>
        @foreach($languages as $language)
            @if($loop->first)
                <loc>{{ $app }}/{{ $language }}{{ $crag->url(false) }}</loc>
            @else
                <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{ $language }}{{ $crag->url(false) }}" />
            @endif
        @endforeach
        <lastmod>{{ $crag->updated_at ? $crag->updated_at->format('Y-m-d') : $crag->created_at->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>1</priority>
    </url>

    {{-- Route --}}
    @foreach($routes as $route)
        <url>
            @foreach($languages as $language)
                @if($loop->first)
                    <loc>{{ $app }}/{{$language}}{{ $route->url(false) }}</loc>
                @else
                    <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{$language}}{{ $route->url(false) }}" />
                @endif
            @endforeach
            <lastmod>{{ $route->updated_at ? $route->updated_at->format('Y-m-d') : $route->created_at->format('Y-m-d') }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

    {{-- Photo --}}
    <url>
        <loc>{{ $app }}/{{$language}}{{ $crag->url(false) }}</loc>
        @foreach($photos as $photo)
            <image:image>
                <image:loc>{{ $app }}/storage/photos/crags/1300/{{ $photo->slug_label }}</image:loc>
            </image:image>
        @endforeach
    </url>

</urlset>