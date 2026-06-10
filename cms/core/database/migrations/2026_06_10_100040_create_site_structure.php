<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        $now = time();

        $categoryId = DB::table('categories')->where('category', 'Kosmos Site')->value('id');
        if (!$categoryId) {
            $categoryId = DB::table('categories')->insertGetId(['category' => 'Kosmos Site', 'rank' => 1]);
        }
        $seoCategoryId = DB::table('categories')->where('category', 'SEO')->value('id');
        if (!$seoCategoryId) {
            $seoCategoryId = DB::table('categories')->insertGetId(['category' => 'SEO', 'rank' => 2]);
        }

        // ---------- Шаблоны ----------
        $templates = [
            'main'     => ['Главная страница', 'Первый экран, направления, калькулятор, пакеты, портфолио'],
            'cluster'  => ['Страница направления', 'Кластерная страница услуг: hero, прайс, галерея, FAQ'],
            'contacts' => ['Контакты', 'Контакты, карта, форма записи'],
            'service'  => ['Текстовая страница', 'Служебные и текстовые страницы (404 и т.п.)'],
            'sitemap'  => ['Sitemap XML', 'Карта сайта для поисковых систем'],
        ];

        $templateIds = [];
        foreach ($templates as $alias => [$name, $description]) {
            $id = DB::table('site_templates')->where('templatealias', $alias)->value('id');
            if (!$id) {
                $id = DB::table('site_templates')->insertGetId([
                    'templatename'  => $name,
                    'templatealias' => $alias,
                    'description'   => $description,
                    'category'      => $categoryId,
                    'content'       => '',
                    'selectable'    => 1,
                    'createdon'     => $now,
                    'editedon'      => $now,
                ]);
            }
            $templateIds[$alias] = $id;
        }

        // ---------- ТВ-параметры SEO ----------
        $tvs = [
            'seo_keywords'       => ['text', 'Meta keywords', 'Ключевые слова (meta keywords)', '', '', 0],
            'og_title'           => ['text', 'OG: заголовок', 'Заголовок для соцсетей (og:title). Пусто — расширенный заголовок страницы', '', '', 1],
            'og_image'           => ['image', 'OG: изображение', 'Картинка для соцсетей (og:image)', '', '', 2],
            'seo_robots'         => ['dropdown', 'Meta robots', 'Индексация страницы', 'По умолчанию==||index,follow==index,follow||noindex,nofollow==noindex,nofollow||noindex,follow==noindex,follow', '', 3],
            'seo_canonical'      => ['text', 'Canonical URL', 'Канонический адрес. Пусто — адрес страницы', '', '', 4],
            'sitemap_exclude'    => ['checkbox', 'Скрыть из sitemap', 'Не выводить страницу в sitemap.xml', 'Да==1', '', 5],
            'sitemap_changefreq' => ['dropdown', 'Sitemap: частота', 'Частота изменения для sitemap.xml', 'weekly==weekly||daily==daily||monthly==monthly||yearly==yearly', 'weekly', 6],
            'sitemap_priority'   => ['dropdown', 'Sitemap: приоритет', 'Приоритет страницы для sitemap.xml', '0.5==0.5||1.0==1.0||0.9==0.9||0.8==0.8||0.7==0.7||0.6==0.6||0.4==0.4||0.3==0.3', '0.8', 7],
        ];

        $tvIds = [];
        foreach ($tvs as $name => [$type, $caption, $description, $elements, $default, $rank]) {
            $id = DB::table('site_tmplvars')->where('name', $name)->value('id');
            if (!$id) {
                $id = DB::table('site_tmplvars')->insertGetId([
                    'type'         => $type,
                    'name'         => $name,
                    'caption'      => $caption,
                    'description'  => $description,
                    'elements'     => $elements,
                    'default_text' => $default,
                    'rank'         => $rank,
                    'category'     => $seoCategoryId,
                    'createdon'    => $now,
                    'editedon'     => $now,
                ]);
            }
            $tvIds[$name] = $id;
        }

        foreach (['main', 'cluster', 'contacts', 'service'] as $templateAlias) {
            foreach ($tvIds as $tvId) {
                if (!DB::table('site_tmplvar_templates')->where(['tmplvarid' => $tvId, 'templateid' => $templateIds[$templateAlias]])->exists()) {
                    DB::table('site_tmplvar_templates')->insert([
                        'tmplvarid'  => $tvId,
                        'templateid' => $templateIds[$templateAlias],
                        'rank'       => 0,
                    ]);
                }
            }
        }

        // ---------- Ресурсы ----------
        $resources = require __DIR__ . '/../seeds/content/resources.php';

        foreach ($resources as $id => $resource) {
            $tvValues = $resource['tvs'] ?? [];
            unset($resource['tvs']);

            $resource += [
                'type'        => 'document',
                'contentType' => 'text/html',
                'published'   => 1,
                'publishedon' => $now,
                'createdon'   => $now,
                'editedon'    => $now,
                'parent'      => 0,
                'richtext'    => 0,
                'hidemenu'    => 0,
                'searchable'  => 1,
                'cacheable'   => 1,
            ];
            $resource['template'] = $templateIds[$resource['template']];

            DB::table('site_content')->updateOrInsert(['id' => $id], $resource);

            foreach ($tvValues as $tvName => $value) {
                DB::table('site_tmplvar_contentvalues')->updateOrInsert(
                    ['tmplvarid' => $tvIds[$tvName], 'contentid' => $id],
                    ['value' => $value]
                );
            }
        }

        // ---------- Системные настройки ----------
        $settings = require __DIR__ . '/../seeds/content/settings.php';
        foreach ($settings as $name => $value) {
            DB::table('system_settings')->updateOrInsert(
                ['setting_name' => $name],
                ['setting_value' => $value]
            );
        }
    }

    public function down()
    {
        $tvNames = ['seo_keywords', 'og_title', 'og_image', 'seo_robots', 'seo_canonical', 'sitemap_exclude', 'sitemap_changefreq', 'sitemap_priority'];
        $tvIds = DB::table('site_tmplvars')->whereIn('name', $tvNames)->pluck('id');

        DB::table('site_tmplvar_contentvalues')->whereIn('tmplvarid', $tvIds)->delete();
        DB::table('site_tmplvar_templates')->whereIn('tmplvarid', $tvIds)->delete();
        DB::table('site_tmplvars')->whereIn('id', $tvIds)->delete();

        $resources = require __DIR__ . '/../seeds/content/resources.php';
        DB::table('site_content')->whereIn('id', array_keys($resources))->delete();

        DB::table('site_templates')->whereIn('templatealias', ['main', 'cluster', 'contacts', 'service', 'sitemap'])->delete();
    }
};
