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
        Schema::create('celebration_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile_num', 20);
            $table->string('email');
            $table->text('address');
            $table->string('emergency_contact', 20);
            $table->integer('family_members');
            $table->integer('children_count')->default(0);
            $table->boolean('has_driver')->default(false);
            $table->string('nid')->nullable();
            $table->string('passport_photo')->nullable();
            $table->string('payment_method');
            $table->string('transaction_number');
            $table->string('transaction_screenshot')->nullable();
            $table->decimal('amount', 10, 2);
            // New fields
            $table->string('bncc_batch')->nullable();
            $table->string('religion')->nullable();
            $table->boolean('has_children_under_five')->nullable();
            $table->boolean('attend_wednesday_night')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('celebration_registrations');
    }
};