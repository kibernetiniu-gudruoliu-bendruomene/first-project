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
        Schema::create('meetings', function (Blueprint $table) {

            /**
             * for contextual info about the structure of the table,
             * refer to docs/feature-docs/meeting-migration
             */

            // This id is to solve digitalocean's requirement for primary id (https://stackoverflow.com/questions/62418099/unable-to-create-or-change-a-table-without-a-primary-key-laravel-digitalocean)
            $table->id('db_id')->unique();
            
            $table->uuid('id')->unique(); // string
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->longText('description');
            $table->string('location')->default('Not specified');
            $table->string('timezone');
            $table->smallInteger('duration')->default('30');
            $table->integer('delete_after')->default('90');
            $table->tinyInteger('is1v1')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
