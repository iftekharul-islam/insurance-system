<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterNoticeTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notice_tbls', function (Blueprint $table) {
            $table->string("notice")->nullable()->change();
            $table->string('notice_type')->nullable()->change();
            $table->string('notice_pdf')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notice_tbls', function (Blueprint $table) {
            //
        });
    }
}
