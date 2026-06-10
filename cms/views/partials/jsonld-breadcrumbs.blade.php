@php
    $siteUrl = rtrim(evo()->getConfig('site_url'), '/');
    $docUrl  = $siteUrl . UrlProcessor::makeUrl($documentObject['id']);
@endphp
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $siteUrl . '/'],
        ['@type' => 'ListItem', 'position' => 2, 'name' => $documentObject['pagetitle'], 'item' => $docUrl],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
