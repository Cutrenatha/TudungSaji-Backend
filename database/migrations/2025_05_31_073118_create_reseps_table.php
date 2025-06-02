<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



class CreateResepsTable extends Migration // Or: return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Check if the table already exists before trying to create it
        if (!Schema::hasTable('reseps')) {
            Schema::create('reseps', function (Blueprint $table) {
                $table->id();
                // This assumes your users table is named 'users' (default Laravel behavior)
                // If it's different, you'll need to specify: ->constrained('your_users_table_name')
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('judul');
                $table->text('deskripsi')->nullable();
                $table->string('gambar')->nullable();
                $table->string('porsi')->nullable();
                $table->string('lama_memasak')->nullable();
                $table->json('bahan_bahan')->nullable();        // array bahan
                $table->json('langkah_memasak')->nullable();    // array langkah
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reseps');
    }
}