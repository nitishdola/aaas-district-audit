<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addauditcols extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tms_data_records', function (Blueprint $table) {
            $table->boolean('telephonic_audit_completed')->default(false)->after('record_status');
            $table->boolean('home_visit_completed')->default(false)->after('telephonic_audit_completed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tms_data_records', function (Blueprint $table) {
            //
        });
    }
}
