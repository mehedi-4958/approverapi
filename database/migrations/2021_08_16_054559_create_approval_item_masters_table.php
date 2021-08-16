<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovalItemMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approval_item_masters', function (Blueprint $table) {
            $table->id('ID');
            $table->string('Title');
            $table->string('Subtitle')->nullable();
            $table->text('Description')->nullable();
            $table->double('Amount');
            $table->string('Thumb');
            $table->string('LargeImage');
            $table->string('Status');
            $table->string('DeclinedReason');
            $table->dateTime('Submitted At');
            $table->dateTime('Approved At');
            $table->dateTime('Declined At');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approval_item_masters');
    }
}
