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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('design');
            $table->string('profile_photo');
            $table->string('color');
            $table->string('logo');
            $table->string('badge');
            $table->string('card_name');
            $table->string('prefix');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('suffix');
            $table->string('accreditation');
            $table->string('preferred_name');
            $table->string('mainden_name');
            $table->string('pronouns');
            $table->string('title');
            $table->string('department');
            $table->string('company');
            $table->text('headline');
            $table->string('company');
            $table->string('website_text');
            $table->string('website_link');
            $table->string('link_text');
            $table->string('link_link');
            $table->string('instagram_text');
            $table->string('website_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
