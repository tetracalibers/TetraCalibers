<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnLearningUnitIdToClearnote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clearnotes', function (Blueprint $table) {
            $table->integer('learnings_unit_id')->after('thumbnail');
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
            $table->dropColumn('learnings_unit_id');
        });
    }
}
