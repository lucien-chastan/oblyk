{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($crags as $crag)
    <sitemap>
        <loc>{{ route('sitemapCragRoutes', ['crag_id'=>$crag->id]) }}</loc>
        <lastmod>{{{ $crag->updated_at ? $crag->updated_at->format('Y-m-d') : $crag->created_at->format('Y-m-d')  }}}</lastmod>
    </sitemap>
    @endforeach
</sitemapindex>