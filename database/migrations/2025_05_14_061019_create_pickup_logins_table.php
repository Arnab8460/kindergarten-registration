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
        Schema::create('pickup_logins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pickup_person_id')->constrained()->onDelete('cascade');
            $table->string('contact_no');
            $table->timestamp('logged_in_at')->default(now());
            $table->timestamps();
            });
    }

};
