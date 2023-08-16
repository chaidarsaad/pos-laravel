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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('address1')->nullable();
            $table->tinyInteger('districts_id')->default('1');
            $table->tinyInteger('role_as')->default('0');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'name' => 'Chaidar Saad',
            'email' => 'chaidarsaad55@gmail.com',
            'password' => bcrypt('11111111'),
            'phone' => '+6285156506238',
            'address1' => 'Paiton',
            'districts_id' => 1,
            'role_as' => '1',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
