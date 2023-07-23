<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalColumnsBenAuditDb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficiary_audits', function (Blueprint $table) {
            $table->string('telephonic_audit_finding')->nullable()->after('id');
            $table->string('latitude')->nullable()->after('telephonic_audit_finding');
            $table->string('longitude')->nullable()->after('latitude');
            $table->string('address')->nullable()->after('longitude');
            $table->enum('beneficiary_satisfied_with_treatment', ['Yes', 'No'])->default('No')->after('address');
            $table->string('photo_of_beneficiary')->nullable()->after('beneficiary_satisfied_with_treatment');
            $table->enum('cashless_treatment', ['Yes', 'No'])->default('No')->after('photo_of_beneficiary');
            $table->string('cashless_treatment_no_receipt')->nullable()->after('cashless_treatment');
            $table->string('remarks')->after('cashless_treatment_no_receipt');
            $table->boolean('status')->default(1)->after('remarks');
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
