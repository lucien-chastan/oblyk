{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ route('sitemapCommon') }}</loc>
        <lastmod>{{ \Carbon\Carbon::now()->format('Y-m-d') }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ route('sitemapClimbers') }}</loc>
        <lastmod>{{ $lastUser->created_at->format('Y-m-d') }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ route('sitemapTopos') }}</loc>
        <lastmod>{{ $lastTopo->created_at->format('Y-m-d') }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ route('sitemapGyms') }}</loc>
        <lastmod>{{ $lastGym->created_at->format('Y-m-d') }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ route('sitemapTopics') }}</loc>
        <lastmod>{{ $lastTopic->created_at->format('Y-m-d') }}</lastmod>
    </sitemap>
</sitemapindex>