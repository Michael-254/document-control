<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('document_no')->nullable();
            $table->string('title')->nullable();
            $table->date('date_created')->nullable();
            $table->string('revision_status')->nullable();
            $table->string('status')->default('pending');
            $table->string('department')->nullable();
            $table->string('location')->nullable();
            $table->unsignedBigInteger('person_incharge')->nullable();
            $table->unsignedBigInteger('document_creator')->nullable();
            $table->text('uploader_comment')->nullable();
            $table->unsignedBigInteger('HOD_revisor')->nullable();
            $table->date('HOD_date')->nullable();
            $table->text('HOD_comment')->nullable();
            $table->unsignedBigInteger('QC_revisor')->nullable();
            $table->date('QC_date')->nullable();
            $table->text('QC_comment')->nullable();
            $table->unsignedBigInteger('MD_approver')->nullable();
            $table->date('MD_date')->nullable();
            $table->text('MD_comment')->nullable();
            $table->unsignedBigInteger('implementor')->nullable();
            $table->date('implementor_date')->nullable();
            $table->text('implementor_comment')->nullable();
            $table->date('implementation_date')->nullable();
            $table->string('file');
            $table->string('qr_code')->nullable();
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
        Schema::dropIfExists('documents');
    }
}
