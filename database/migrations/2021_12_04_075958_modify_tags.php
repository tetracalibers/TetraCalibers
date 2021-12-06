<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // カラム名を変更
        Schema::table('tags', function (Blueprint $table) {
            $table->renameColumn('frequency', 'level');
        });

        // 型を変更
        Schema::table('tags', function (Blueprint $table) {
            $table->Integer('level')->default(-1)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 型を戻す
        Schema::table('tags', function (Blueprint $table) {
            $table->Integer('level')->default(NULL)->change();
        });

        // カラム名を戻す
        Schema::table('tags', function (Blueprint $table) {
            $table->renameColumn('level','frequency');
        });
    }
}
