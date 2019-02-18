{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">

    {{--Home page--}}
    <url>
        @foreach($languages as $language)
            @if($loop->first)
                <loc>{{ $app }}/{{ $language }}</loc>
            @else
                <xhtml:link rel="alternate" hreflang="{{ $app }}/{{ $language }}" />
            @endif
        @endforeach
        <lastmod>{{ \Carbon\Carbon::now()->format('Y-m-d') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1</priority>
    </url>

    {{--Project page--}}
    <url>
        @foreach($languages as $language)
            @if($loop->first)
                <loc>{{ $app }}/{{ $language }}{{ route('project',[],false) }}</loc>
            @else
                <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{ $language }}{{ route('project',[],false) }}" />
            @endif
        @endforeach
        <lastmod>2017-10-01</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        @foreach($languages as $language)
            @if($loop->first)
                <loc>{{ $app }}/{{ $language }}{{ route('contact',[],false) }}</loc>
            @else
                <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{ $language }}{{ route('contact',[],false) }}" />
            @endif
        @endforeach
        <lastmod>2017-10-01</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        @foreach($languages as $language)
            @if($loop->first)
                <loc>{{ $app }}/{{ $language }}{{ route('about',[],false) }}</loc>
            @else
                <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{ $language }}{{ route('about',[],false) }}" />
            @endif
        @endforeach
        <lastmod>2017-10-01</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        @foreach($languages as $language)
            @if($loop->first)
                <loc>{{ $app }}/{{ $language }}{{ route('help',[],false) }}</loc>
            @else
                <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{ $language }}{{ route('help',[],false) }}" />
            @endif
        @endforeach
        <lastmod>2017-10-01</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        @foreach($languages as $language)
            @if($loop->first)
                <loc>{{ $app }}/{{ $language }}{{ route('supportUs',[],false) }}</loc>
            @else
                <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{ $language }}{{ route('supportUs',[],false) }}" />
            @endif
        @endforeach
        <lastmod>2017-10-01</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        @foreach($languages as $language)
            @if($loop->first)
                <loc>{{ $app }}/{{ $language }}{{ route('developer',[],false) }}</loc>
            @else
                <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{ $language }}{{ route('developer',[],false) }}" />
            @endif
        @endforeach
        <lastmod>2017-10-01</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        @foreach($languages as $language)
            @if($loop->first)
                <loc>{{ $app }}/{{ $language }}{{ route('termsOfUse',[],false) }}</loc>
            @else
                <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{ $language }}{{ route('termsOfUse',[],false) }}" />
            @endif
        @endforeach
        <lastmod>2017-10-01</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.1</priority>
    </url>
    <url>
        @foreach($languages as $language)
            @if($loop->first)
                <loc>{{ $app }}/{{ $language }}{{ route('subscribe',[],false) }}</loc>
            @else
                <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{ $language }}{{ route('subscribe',[],false) }}" />
            @endif
        @endforeach
        <lastmod>2018-05-01</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        @foreach($languages as $language)
            @if($loop->first)
                <loc>{{ $app }}/{{ $language }}{{ route('lexique',[],false) }}</loc>
            @else
                <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{ $language }}{{ route('lexique',[],false) }}" />
            @endif
        @endforeach
        <lastmod>{{ $lastWord->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        @foreach($languages as $language)
            @if($loop->first)
                <loc>{{ $app }}/{{ $language }}{{ route('grade',[],false) }}</loc>
            @else
                <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{ $language }}{{ route('grade',[],false) }}" />
            @endif
        @endforeach
        <lastmod>2018-01-01</lastmod>
        <changefreq>never</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        @foreach($languages as $language)
            @if($loop->first)
                <loc>{{ $app }}/{{ $language }}{{ route('partnerHowPage',[],false) }}</loc>
            @else
                <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{ $language }}{{ route('partnerHowPage',[],false) }}" />
            @endif
        @endforeach
        <lastmod>2018-01-01</lastmod>
        <changefreq>never</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        @foreach($languages as $language)
            @if($loop->first)
                <loc>{{ $app }}/{{ $language }}{{ route('articlesPage',[],false) }}</loc>
            @else
                <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{ $language }}{{ route('articlesPage',[],false) }}" />
            @endif
        @endforeach
        <lastmod>{{ $lastArticles->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>

    {{-- Articles --}}
    @foreach($articles as $article)
        <url>
            @foreach($languages as $language)
                @if($loop->first)
                    <loc>{{ $app }}/{{ $language }}{{ $article->url(false) }}</loc>
                @else
                    <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{ $language }}{{ $article->url(false) }}" />
                @endif
            @endforeach
            <lastmod>{{ $article->updated_at->format('Y-m-d') }}</lastmod>
            <changefreq>never</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach


    {{-- Carte --}}
    <url>
        @foreach($languages as $language)
            @if($loop->first)
                <loc>{{ $app }}/{{ $language }}{{ route('map',[],false) }}</loc>
            @else
                <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{ $language }}{{ route('map',[],false) }}" />
            @endif
        @endforeach
        <lastmod>{{ $lastCrag->format('Y-m-d') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        @foreach($languages as $language)
            @if($loop->first)
                <loc>{{ $app }}/{{ $language }}{{ route('mapGym',[],false) }}</loc>
            @else
                <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{ $language }}{{ route('mapGym',[],false) }}" />
            @endif
        @endforeach
        <lastmod>{{ $lastGym->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1</priority>
    </url>

    {{-- Forum--}}
    <url>
        @foreach($languages as $language)
            @if($loop->first)
                <loc>{{ $app }}/{{ $language }}{{ route('forum',[],false) }}</loc>
            @else
                <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{ $language }}{{ route('forum',[],false) }}" />
            @endif
        @endforeach
        <lastmod>2018-01-01</lastmod>
        <changefreq>never</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        @foreach($languages as $language)
            @if($loop->first)
                <loc>{{ $app }}/{{ $language }}{{ route('forumCategories',[],false) }}</loc>
            @else
                <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{ $language }}{{ route('forumCategories',[],false) }}" />
            @endif
        @endforeach
        <lastmod>2018-01-01</lastmod>
        <changefreq>never</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        @foreach($languages as $language)
            @if($loop->first)
                <loc>{{ $app }}/{{ $language }}{{ route('forumTopics',[],false) }}</loc>
            @else
                <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{ $language }}{{ route('forumTopics',[],false) }}" />
            @endif
        @endforeach
        <lastmod>{{ $lastTopic->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        @foreach($languages as $language)
            @if($loop->first)
                <loc>{{ $app }}/{{ $language }}{{ route('forumRules',[],false) }}</loc>
            @else
                <xhtml:link rel="alternate" hreflang="{{ $language }}" href="{{ $app }}/{{ $language }}{{ route('forumRules',[],false) }}" />
            @endif
        @endforeach
        <lastmod>2018-01-01</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.5</priority>
    </url>
</urlset>