<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        $now = time();

        $categoryId = DB::table('categories')->where('category', 'Manager and Admin')->value('id');
        if (!$categoryId) {
            $categoryId = DB::table('categories')->insertGetId(['category' => 'Manager and Admin', 'rank' => 0]);
        }

        // Кастомные события PageBuilder (обычно создаются плагином при первом запуске)
        foreach (['OnPBContainerRender', 'OnPBFieldRender'] as $event) {
            if (!DB::table('system_eventnames')->where('name', $event)->exists()) {
                DB::table('system_eventnames')->insert([
                    'name'      => $event,
                    'service'   => 6,
                    'groupname' => 'PageBuilder',
                ]);
            }
        }

        if (!DB::table('site_snippets')->where('name', 'PageBuilder')->exists()) {
            DB::table('site_snippets')->insert([
                'name'        => 'PageBuilder',
                'description' => 'Выводит блоки контента текущей страницы',
                'category'    => $categoryId,
                'snippet'     => require __DIR__ . '/../seeds/elements/pagebuilder_snippet.php',
                'createdon'   => $now,
                'editedon'    => $now,
            ]);
        }

        if (!DB::table('site_plugins')->where('name', 'PageBuilder')->exists()) {
            $pluginId = DB::table('site_plugins')->insertGetId([
                'name'        => 'PageBuilder',
                'description' => 'Конструктор блоков страницы',
                'category'    => $categoryId,
                'plugincode'  => require __DIR__ . '/../seeds/elements/pagebuilder_plugin.php',
                'properties'  => '&tabName=Tab name;text;Конструктор &addType=Add type;menu;dropdown,icons,images;dropdown &placement=Placement;menu;content,tab;tab &order=Default container ordering;text;0',
                'disabled'    => 0,
                'createdon'   => $now,
                'editedon'    => $now,
            ]);

            // OnWebPageInit/OnManagerPageInit не привязываем: их разовую работу
            // (создание кастомных событий) уже сделала эта миграция.
            $events = ['OnDocFormRender', 'OnDocFormSave', 'OnBeforeEmptyTrash', 'OnDocDuplicate'];
            $eventIds = DB::table('system_eventnames')->whereIn('name', $events)->pluck('id');

            foreach ($eventIds as $eventId) {
                DB::table('site_plugin_events')->insert([
                    'pluginid' => $pluginId,
                    'evtid'    => $eventId,
                    'priority' => 0,
                ]);
            }
        }
    }

    public function down()
    {
        $pluginId = DB::table('site_plugins')->where('name', 'PageBuilder')->value('id');
        if ($pluginId) {
            DB::table('site_plugin_events')->where('pluginid', $pluginId)->delete();
            DB::table('site_plugins')->where('id', $pluginId)->delete();
        }
        DB::table('site_snippets')->where('name', 'PageBuilder')->delete();
        DB::table('system_eventnames')->whereIn('name', ['OnPBContainerRender', 'OnPBFieldRender'])->delete();
    }
};
