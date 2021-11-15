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
            $table->string('title');
            $table->string('date_created');
            $table->string('revision_status');
            $table->unsignedBigInteger('person_incharge');
            $table->unsignedBigInteger('document_creator');
            $table->unsignedBigInteger('revisor');
            $table->unsignedBigInteger('approver');
            $table->string('department');
            $table->string('location');
            $table->string('file');
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
