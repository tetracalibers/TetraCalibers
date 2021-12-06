<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUseableToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('useable_tools');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('useable_tools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('level')->comment('勉強中・読み書きできる・書き慣れてきた・作りたいものが作れる');
            $table->text('logo')->nullable();
            $table->text('appeal')->nullable();
            $table->timestamps();
        });
    }
}
