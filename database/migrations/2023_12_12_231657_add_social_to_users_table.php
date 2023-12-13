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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('cv')->after('password')->default("No cv");
            $table->string('job_title')->default("No job title");
            $table->string('bio')->default("No bio");
            $table->string('twitter')->default("No twitter");
            $table->string('facebook')->default("No facebook");
            $table->string('linkedin')->default("No linkedin");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('cv');
            $table->dropColumn('job_title');
            $table->dropColumn('bio');
            $table->dropColumn('twitter');
            $table->dropColumn('facebook');
            $table->dropColumn('linkedin');
        });
    }
};
