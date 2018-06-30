{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    @foreach($topics as $topics)
        <url>
            @foreach($languages as $language)
                @if($loop->first)
                    <loc>{{ $app }}/{{$language}}{{route('topicPage', ['topic_label'=> str_slug($topics->label), 'topic_id'=>$topics->id], false)}}</loc>
                @else
                    <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{$language}}{{route('topicPage', ['topic_label'=> str_slug($topics->label), 'topic_id'=>$topics->id], false)}}" />
                @endif
            @endforeach
            <lastmod>{{ $topics->updated_at ? $topics->updated_at->format('Y-m-d') : $topics->created_at->format('Y-m-d') }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach
</urlset>