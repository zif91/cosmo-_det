<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    private string $guid = 'clsee234523g354f542t5t';

    public function up()
    {
        $now = time();

        $categoryId = DB::table('categories')->where('category', 'Manager and Admin')->value('id');
        if (!$categoryId) {
            $categoryId = DB::table('categories')->insertGetId(['category' => 'Manager and Admin', 'rank' => 0]);
        }

        foreach (['OnBeforeClientSettingsSave', 'OnClientSettingsSave'] as $event) {
            if (!DB::table('system_eventnames')->where('name', $event)->exists()) {
                DB::table('system_eventnames')->insert([
                    'name'      => $event,
                    'service'   => 6,
                    'groupname' => 'ClientSettings',
                ]);
            }
        }

        $moduleId = DB::table('site_modules')->where('name', 'ClientSettings')->value('id');
        if (!$moduleId) {
            $moduleId = DB::table('site_modules')->insertGetId([
                'name'                => 'ClientSettings',
                'description'         => 'Настройки сайта',
                'category'            => $categoryId,
                'guid'                => $this->guid,
                'enable_sharedparams' => 1,
                'properties'          => '&prefix=Prefix for settings;text;client_ &config_path=Path to configuration files;text;',
                'modulecode'          => require __DIR__ . '/../seeds/elements/clientsettings_module.php',
                'createdon'           => $now,
                'editedon'            => $now,
            ]);
        }

        $pluginId = DB::table('site_plugins')->where('name', 'ClientSettings')->value('id');
        if (!$pluginId) {
            $pluginId = DB::table('site_plugins')->insertGetId([
                'name'        => 'ClientSettings',
                'description' => 'Пункт меню для модуля ClientSettings',
                'category'    => $categoryId,
                'plugincode'  => require __DIR__ . '/../seeds/elements/clientsettings_menu_plugin.php',
                'moduleguid'  => $this->guid,
                'disabled'    => 0,
                'createdon'   => $now,
                'editedon'    => $now,
            ]);

            $eventId = DB::table('system_eventnames')->where('name', 'OnManagerMenuPrerender')->value('id');
            if ($eventId) {
                DB::table('site_plugin_events')->insert([
                    'pluginid' => $pluginId,
                    'evtid'    => $eventId,
                    'priority' => 0,
                ]);
            }
        }

        // связь «плагин принадлежит модулю» (type 30 = plugins)
        if (!DB::table('site_module_depobj')->where(['module' => $moduleId, 'resource' => $pluginId, 'type' => 30])->exists()) {
            DB::table('site_module_depobj')->insert([
                'module'   => $moduleId,
                'resource' => $pluginId,
                'type'     => 30,
            ]);
        }
    }

    public function down()
    {
        $moduleId = DB::table('site_modules')->where('name', 'ClientSettings')->value('id');
        $pluginId = DB::table('site_plugins')->where('name', 'ClientSettings')->value('id');

        if ($pluginId) {
            DB::table('site_plugin_events')->where('pluginid', $pluginId)->delete();
            DB::table('site_plugins')->where('id', $pluginId)->delete();
        }
        if ($moduleId) {
            DB::table('site_module_depobj')->where('module', $moduleId)->delete();
            DB::table('site_modules')->where('id', $moduleId)->delete();
        }
        DB::table('system_eventnames')->whereIn('name', ['OnBeforeClientSettingsSave', 'OnClientSettingsSave'])->delete();
    }
};
