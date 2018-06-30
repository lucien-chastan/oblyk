{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    @foreach($climbers as $climber)
        <url>
            @foreach($languages as $language)
                @if($loop->first)
                    <loc>{{ $app }}/{{$language}}{{route('userPage', ['user_name'=> str_slug($climber->name), 'user_id'=>$climber->id], false)}}</loc>
                @else
                    <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{$language}}{{route('userPage', ['user_name'=> str_slug($climber->name), 'user_id'=>$climber->id], false)}}" />
                @endif
            @endforeach
            <lastmod>{{ $climber->updated_at ? $climber->updated_at->format('Y-m-d') : $climber->created_at->format('Y-m-d') }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach
</urlset>