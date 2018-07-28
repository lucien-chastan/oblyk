{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    @foreach($topics as $topic)
        <url>
            @foreach($languages as $language)
                @if($loop->first)
                    <loc>{{ $app }}/{{ $language }}{{ $topic->url(false) }}</loc>
                @else
                    <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{ $language }}{{ $topic->url(false) }}" />
                @endif
            @endforeach
            <lastmod>{{ $topic->updated_at ? $topic->updated_at->format('Y-m-d') : $topic->created_at->format('Y-m-d') }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach
</urlset>