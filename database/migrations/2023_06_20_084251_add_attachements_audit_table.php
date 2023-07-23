<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttachementsAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficiary_audit_attachments', function (Blueprint $table) {
            $table->bigInteger('beneficiary_audit_id', false, true)->after('id');
            $table->string('attachment_name');
            $table->string('attachment_path')->unique();
            $table->boolean('status')->default(1);
            $table->foreign('beneficiary_audit_id')->references('id')->on('beneficiary_audits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beneficiary_audit_attachments', function (Blueprint $table) {
            //
        });
    }
}
