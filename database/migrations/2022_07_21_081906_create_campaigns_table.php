<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->string('subject')->nullable();
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->integer('status')->default(0);
            $table->integer('send_type')->default(1);
            $table->string('send_values')->nullable();
            $table->boolean('is_private')->default(true);
            $table->integer('sent_count')->default(0);
            $table->integer('fail_count')->default(0);
            $table->integer('open_count')->default(0);
            $table->integer('reply_count')->default(0);
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
        Schema::dropIfExists('campaigns');
    }
};
