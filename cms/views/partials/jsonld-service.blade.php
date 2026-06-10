@php $cfg = fn ($key, $default = '') => evo()->getConfig($key, $default); @endphp
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Service',
    'serviceType' => $documentObject['pagetitle'],
    'areaServed' => $cfg('client_area_served', 'Санкт-Петербург, Василеостровский район'),
    'provider' => [
        '@type' => 'AutoRepair',
        'name' => $cfg('client_org_name', 'Космос Детейлинг Студия'),
        'telephone' => $cfg('client_phone'),
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $cfg('client_street'),
            'addressLocality' => 'Санкт-Петербург',
            'postalCode' => $cfg('client_postal_code'),
            'addressCountry' => 'RU',
        ],
        'geo' => ['@type' => 'GeoCoordinates', 'latitude' => (float) $cfg('client_geo_lat', 59.969), 'longitude' => (float) $cfg('client_geo_lon', 30.209)],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
