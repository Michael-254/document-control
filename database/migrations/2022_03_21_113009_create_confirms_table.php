<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doc_id');
            $table->boolean('received');
            $table->string('received_comment')->nullable();
            $table->boolean('read');
            $table->string('read_comment')->nullable();
            $table->boolean('doc_implemented');
            $table->string('doc_implemented_comment')->nullable();
            $table->boolean('destroyed');
            $table->string('destroyed_comment')->nullable();
            $table->string('start_date')->nullable();
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
        Schema::dropIfExists('confirms');
    }
}
