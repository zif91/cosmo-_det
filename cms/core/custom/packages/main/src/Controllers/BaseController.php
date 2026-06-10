<?php

namespace EvolutionCMS\Main\Controllers;

use EvolutionCMS\Models\SiteContent;
use EvolutionCMS\Models\SiteTemplate;

class BaseController
{
    protected array $data = [];

    public function main(): void
    {
        $this->setGlobalData();
        $this->setData();

        EvolutionCMS()->addDataToView($this->data);
    }

    /**
     * Данные конкретного шаблона — переопределяется в наследниках.
     */
    protected function setData(): void
    {
    }

    /**
     * Глобальные данные: меню в шапке, список услуг и контакты для подвала.
     */
    protected function setGlobalData(): void
    {
        $root = SiteContent::query()
            ->select(['id', 'pagetitle', 'menutitle', 'alias', 'template'])
            ->where('parent', 0)
            ->where('published', 1)
            ->where('deleted', 0)
            ->where('hidemenu', 0)
            ->orderBy('menuindex')
            ->get();

        $this->data['mainmenu'] = $root->map(static fn ($doc) => [
            'id'        => $doc->id,
            'title'     => $doc->menutitle ?: $doc->pagetitle,
            'longtitle' => $doc->pagetitle,
            'url'       => \UrlProcessor::makeUrl($doc->id),
        ])->all();

        $clusterTemplate = SiteTemplate::query()->where('templatealias', 'cluster')->value('id');

        $this->data['servicemenu'] = $root
            ->filter(static fn ($doc) => (int) $doc->template === (int) $clusterTemplate)
            ->map(static fn ($doc) => [
                'id'    => $doc->id,
                'title' => $doc->pagetitle,
                'url'   => \UrlProcessor::makeUrl($doc->id),
            ])->values()->all();

        $contacts = $root->firstWhere('alias', 'kontakty');
        $this->data['contactsurl'] = $contacts ? \UrlProcessor::makeUrl($contacts->id) : '';
    }
}
