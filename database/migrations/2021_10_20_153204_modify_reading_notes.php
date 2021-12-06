<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyReadingNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reading_notes', function (Blueprint $table) {
            $table->longText('note')->change();
            $table->longText('structures')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reading_notes', function (Blueprint $table) {
            $table->text('note')->change();
            $table->text('structures')->change();
        });
    }
}
