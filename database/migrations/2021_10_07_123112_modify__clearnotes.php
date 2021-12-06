<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyClearnotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clearnotes', function (Blueprint $table) {
            $table->renameColumn('learnings_unit_id', 'learning_unit_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clearnotes', function (Blueprint $table) {
            $table->renameColumn('learning_unit_id', 'learnings_unit_id');
        });
    }
}
