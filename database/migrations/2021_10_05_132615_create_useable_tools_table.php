<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUseableToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('useable_tools');
    }
}
