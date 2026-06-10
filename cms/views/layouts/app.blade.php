@php
    /** @var array $documentObject */
    $cfg        = fn ($key, $default = '') => evo()->getConfig($key, $default);
    $tv         = fn ($name, $default = '') => is_array($documentObject[$name] ?? null) ? ($documentObject[$name][1] ?: $default) : ($documentObject[$name] ?? $default);
    $siteUrl    = rtrim($cfg('site_url'), '/');
    $isHome     = (int) $documentObject['id'] === (int) $cfg('site_start');
    $docUrl     = $isHome ? $siteUrl . '/' : $siteUrl . UrlProcessor::makeUrl($documentObject['id']);
    $seoTitle   = $documentObject['longtitle'] ?: $documentObject['pagetitle'];
    $seoDesc    = $documentObject['description'] ?: $documentObject['introtext'];
    $canonical  = $tv('seo_canonical') ?: $docUrl;
    $robotsMeta = $tv('seo_robots');
    $ogTitle    = $tv('og_title') ?: $seoTitle;
    $ogImage    = $tv('og_image') ?: $cfg('client_og_image_default', 'assets/img/work-004.jpg');
    $ogImage    = preg_match('~^https?://~', $ogImage) ? $ogImage : $siteUrl . '/' . ltrim($ogImage, '/');
@endphp
<!DOCTYPE html>
<html lang="ru">
<head>
<script>document.documentElement.classList.add('js');setTimeout(function(){if(!window.__kosmosReady){document.querySelectorAll('[data-reveal]').forEach(function(e){e.classList.add('in')})}},2000)</script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<base href="{{ $siteUrl }}/">
<title>{{ $seoTitle }}</title>
<meta name="description" content="{{ $seoDesc }}">
@if($tv('seo_keywords'))<meta name="keywords" content="{{ $tv('seo_keywords') }}">@endif
@if($robotsMeta)<meta name="robots" content="{{ $robotsMeta }}">@endif
<link rel="canonical" href="{{ $canonical }}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $ogTitle }}">
<meta property="og:description" content="{{ $seoDesc }}">
<meta property="og:url" content="{{ $docUrl }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:locale" content="ru_RU">
<meta name="theme-color" content="#05060b">
<link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Ccircle cx='16' cy='16' r='6' fill='%23e6cf9a'/%3E%3Cellipse cx='16' cy='16' rx='14' ry='6' fill='none' stroke='%23e6cf9a' stroke-width='1.4' transform='rotate(-28 16 16)'/%3E%3Ccircle cx='28' cy='9' r='1.8' fill='%23f3e2b6'/%3E%3C/svg%3E">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600;700;800&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/styles.css?v=3">
@hasSection('jsonld')
@yield('jsonld')
@else
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'AutoRepair',
    'name' => $cfg('client_org_name', 'Космос Детейлинг Студия'),
    'image' => $ogImage,
    '@id' => $siteUrl . '/',
    'url' => $siteUrl . '/',
    'telephone' => $cfg('client_phone'),
    'email' => $cfg('client_email'),
    'priceRange' => $cfg('client_price_range', '₽₽₽'),
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => $cfg('client_street'),
        'addressLocality' => 'Санкт-Петербург',
        'addressRegion' => 'Санкт-Петербург',
        'postalCode' => $cfg('client_postal_code'),
        'addressCountry' => 'RU',
    ],
    'geo' => ['@type' => 'GeoCoordinates', 'latitude' => (float) $cfg('client_geo_lat', 59.969), 'longitude' => (float) $cfg('client_geo_lon', 30.209)],
    'areaServed' => $cfg('client_area_served', 'Санкт-Петербург, Василеостровский район'),
    'openingHoursSpecification' => [[
        '@type' => 'OpeningHoursSpecification',
        'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'],
        'opens' => $cfg('client_opens', '10:00'),
        'closes' => $cfg('client_closes', '22:00'),
    ]],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
@endif
{!! $cfg('client_header_codes') !!}
</head>
<body>
<canvas id="stars"></canvas>
<div class="grain" aria-hidden="true"></div>
@include('partials.header')
<main>
@yield('content')
</main>
@include('partials.footer')
<a href="{{ $cfg('client_whatsapp') }}" class="float-wa" aria-label="Написать в WhatsApp" target="_blank" rel="noopener">@include('partials.icon-wa')</a>
<script>window.kosmosApi = {lead: 'api/lead'};</script>
<script src="assets/js/main.js?v=3"></script>
{!! $cfg('client_footer_codes') !!}
</body>
</html>
