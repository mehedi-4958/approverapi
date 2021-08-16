<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovalItemDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approval_item_details', function (Blueprint $table) {
            $table->id('ID');
            $table->bigInteger('ApprovalItemID')->unsigned();
            $table->foreign('ApprovalItemID')->references('ID')->on('approval_item_masters');
            $table->string('Key');
            $table->string('Label1');
            $table->string('Label2');
            $table->string('Label3');
            $table->string('Label4');
            $table->double('Value');
            $table->string('Prefix');
            $table->string('Postfix');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approval_item_details');
    }
}
