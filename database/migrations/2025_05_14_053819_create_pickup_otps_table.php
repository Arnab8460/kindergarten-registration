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
        Schema::create('pickup_otps', function (Blueprint $table) {
            $table->id();
            $table->string('contact_no');
            $table->string('otp');
            $table->timestamp('expires_at');
            $table->timestamps();
        });
        
    }
};
