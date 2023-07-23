<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalColumnsBenAuditType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficiary_audits', function (Blueprint $table) {
            $table->enum('audit_type', ['telephonic_audit', 'home_visit'])->after('cashless_treatment_no_receipt');
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
