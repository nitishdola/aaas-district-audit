<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfrastructureAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infrastructure_audits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('hospital_id', false, true);
            $table->date('date_of_audit');
            $table->bigInteger('user_id', false, true);
            $table->boolean('existence_of_hospital');
            $table->boolean('infrastructure_empanelled_as_per_specialty');
            $table->text('infrastructure_remarks')->nullable();
            $table->boolean('manpower_exist_as_per_specialty');
            $table->text('manpower_remarks')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infrastructure_audits');
    }
}
