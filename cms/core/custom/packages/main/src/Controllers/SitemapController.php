<?php

namespace EvolutionCMS\Main\Controllers;

use EvolutionCMS\Models\SiteContent;
use EvolutionCMS\Models\SiteTmplvar;

class SitemapController extends BaseController
{
    protected function setData(): void
    {
        $core    = EvolutionCMS();
        $siteUrl = rtrim($core->getConfig('site_url'), '/');
        $startId = (int) $core->getConfig('site_start');

        $tvIds = SiteTmplvar::query()
            ->whereIn('name', ['sitemap_exclude', 'sitemap_changefreq', 'sitemap_priority'])
            ->pluck('id', 'name');

        $docs = SiteContent::query()
            ->select(['id', 'editedon', 'createdon', 'contentType'])
            ->where('published', 1)
            ->where('deleted', 0)
            ->where('privateweb', 0)
            ->where('searchable', 1)
            ->where('contentType', 'text/html')
            ->with(['templateValues' => fn ($query) => $query->whereIn('tmplvarid', $tvIds->values())])
            ->orderBy('id')
            ->get();

        $rows = [];

        foreach ($docs as $doc) {
            $tvs = [];
            foreach ($doc->templateValues as $value) {
                $tvs[array_search($value->tmplvarid, $tvIds->all())] = $value->value;
            }

            if (!empty($tvs['sitemap_exclude'])) {
                continue;
            }

            $rows[] = [
                'loc'        => $doc->id === $startId ? $siteUrl . '/' : $siteUrl . \UrlProcessor::makeUrl($doc->id),
                'lastmod'    => date('c', $doc->editedon ?: $doc->createdon ?: time()),
                'changefreq' => $tvs['sitemap_changefreq'] ?? 'weekly',
                'priority'   => $tvs['sitemap_priority'] ?? ($doc->id === $startId ? '1.0' : '0.8'),
            ];
        }

        $this->data['sitemap'] = $rows;
    }
}
