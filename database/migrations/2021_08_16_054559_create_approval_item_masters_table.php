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
            $table->string('Thumb')->nullable();
            $table->string('LargeImage')->nullable();
            $table->string('Status')->nullable();
            $table->string('DeclinedReason')->nullable();
            $table->dateTime('Submitted At')->nullable();
            $table->dateTime('Approved At')->nullable();
            $table->dateTime('Declined At')->nullable();
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
        Schema::dropIfExists('approval_item_masters');
    }
}
