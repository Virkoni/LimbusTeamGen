<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('identities', function (Blueprint $table) {
            $table->id();
            $table->string('sinner'); // character name
            $table->string('identity_name'); // identity name
            $table->enum('rarity', ['0', '00', '000']);
            $table->json('damage_types'); // pierce, slash or blunt
            $table->json('specialties'); // array of specialties
            $table->string('image_url')->nullable(); // using prydwen webp images
            $table->string('season')->default('S1');
            $table->boolean('is_base')->default(false); // filtering bozo ids
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('identities');
    }
};
