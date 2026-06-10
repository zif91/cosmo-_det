<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (Schema::hasTable('pagebuilder')) {
            return;
        }

        Schema::create('pagebuilder', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('document_id');
            $table->string('title')->nullable();
            $table->string('config');
            $table->mediumText('values');
            $table->string('container')->nullable();
            $table->unsignedTinyInteger('visible')->default(1);
            $table->unsignedSmallInteger('index')->default(0);
            $table->index(['document_id', 'container']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pagebuilder');
    }
};
