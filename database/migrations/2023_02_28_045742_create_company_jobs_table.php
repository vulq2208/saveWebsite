<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('form');
            $table->string('experience');
            $table->string('gender');
            $table->string('career')->nullable();
            $table->string('requirements');
            $table->string('education');
            $table->text('description');
            $table->unsignedBigInteger('company_id')->unsigned();
            $table->foreign('company_id')
            ->references('id')
            ->on('companies')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_jobs');
    }
}
