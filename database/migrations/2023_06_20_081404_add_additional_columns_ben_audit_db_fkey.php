<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalColumnsBenAuditDbFkey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficiary_audits', function (Blueprint $table) {
            $table->bigInteger('tms_data_record_id', false, true)->after('id');
            $table->foreign('tms_data_record_id')->references('id')->on('tms_data_records')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beneficiary_audits', function (Blueprint $table) {
            //
        });
    }
}
