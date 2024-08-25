<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      
          Schema::create('tickts', function (Blueprint $table) {
            $table->id();
            $table->enum('issuetype', ['Hardwar', 'Softwar','Network','Security','Email']);
            $table->enum('deliverytype', ['Email', 'Phone Call','Remote','On Site Support','Video Call']);
            $table->enum('place', ['Market-Erbil', 'Market-Mousl','HQ-Alwa','Office Kwestan','Office Shaqlawa','HQ Musel','WareHouse Erbil','WareHouse Mosel']);
            $table->enum('state', ['approved', 'opened','pending','reject']);


            $table->dateTime('startdate');
            $table->dateTime('enddate');
            $table->string('note')->nullable();
            $table->string('reason')->nullable();
            $table->string('responsibility')->nullable();
            $table->foreignId("user_id")->constrained();
            $table->foreignId('problem_id')->constrained('problem_types')->onDelete('cascade');
            $table->foreignId('requets_id')->constrained('requets_froms')->onDelete('cascade');
            $table->foreignId('solution_id')->constrained('solutions')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickts');
    }
};
