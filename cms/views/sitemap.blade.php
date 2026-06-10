{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($sitemap ?? [] as $row)
  <url>
    <loc>{{ $row['loc'] }}</loc>
    <lastmod>{{ $row['lastmod'] }}</lastmod>
    <changefreq>{{ $row['changefreq'] }}</changefreq>
    <priority>{{ $row['priority'] }}</priority>
  </url>
@endforeach
</urlset>
