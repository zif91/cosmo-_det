<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        $blocks = json_decode(file_get_contents(__DIR__ . '/../seeds/content/blocks.json'), true);

        foreach ($blocks as $documentId => $documentBlocks) {
            if (DB::table('pagebuilder')->where('document_id', $documentId)->exists()) {
                continue;
            }

            foreach (array_values($documentBlocks) as $index => [$config, $values]) {
                DB::table('pagebuilder')->insert([
                    'document_id' => $documentId,
                    'container'   => 'default',
                    'config'      => $config,
                    'values'      => json_encode($values, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    'visible'     => 1,
                    'index'       => $index,
                ]);
            }
        }
    }

    public function down()
    {
        $blocks = json_decode(file_get_contents(__DIR__ . '/../seeds/content/blocks.json'), true);
        DB::table('pagebuilder')->whereIn('document_id', array_keys($blocks))->delete();
    }
};
