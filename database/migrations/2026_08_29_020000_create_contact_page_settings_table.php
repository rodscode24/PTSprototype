<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_page_settings', function (Blueprint $table): void {
            $table->id();
            $table->string('hero_eyebrow');
            $table->string('hero_title');
            $table->string('hero_subtitle');
            $table->string('hero_image_path')->nullable();
            $table->string('contact_heading');
            $table->text('notice');
            $table->string('phone');
            $table->string('fax')->nullable();
            $table->string('public_email');
            $table->string('form_to_email');
            $table->text('address');
            $table->text('hours');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_page_settings');
    }
};
