<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('site_leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('phone', 32);
            $table->string('car', 150)->default('');
            $table->string('services', 500)->default('');
            $table->string('booking', 200)->default('');
            $table->string('source', 200)->default('');
            $table->string('ip', 45)->default('');
            $table->dateTime('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('site_leads');
    }
};
