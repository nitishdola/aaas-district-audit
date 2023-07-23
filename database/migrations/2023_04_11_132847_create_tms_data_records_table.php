<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmsDataRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tms_data_records', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tms_data_id', false, true);
            $table->string('patient_name');
            $table->string('card_no');
            $table->string('hhd_type');
            $table->string('age');
            $table->string('gender');
            $table->string('contact_no');
            $table->string('district_name');
            $table->string('pat_state');
            $table->string('hospdist');
            $table->string('hosp_name');
            $table->string('hosp_disp_code');
            $table->string('hosp_type');
            $table->string('case_no');
            $table->date('case_regn_date');
            $table->date('cs_dis_dt')->nullable();
            $table->date('cs_preauth_dt');
            $table->decimal('preauth_raised_amt',20,2);
            $table->string('status');
            $table->string('category_disp_code');
            $table->string('dis_main_name');
            $table->string('procedure_disp_id');
            $table->string('procedure_name');
            $table->boolean('record_status')->default(1);
            $table->timestamps();

            $table->foreign('tms_data_id')->references('id')->on('tms_data')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tms_data_records');
    }
}
