<?php
// database/migrations/2024_12_26_000000_create_films_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->year('year')->nullable();
            $table->text('synopsis')->nullable();
            $table->foreignId('director_id')->constrained('directors')->onDelete('cascade');
            $table->string('image')->nullable(); // Colonne pour le chemin de l'image
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('films');
    }
}
