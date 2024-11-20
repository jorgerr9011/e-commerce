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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('details');
            $table->string('price');
            $table->unsignedInteger('discounts');
            $table->timestamps();

            /*
            Si queremos algún valor por defecto: 
                $table->boolean('done')->default(false);

            Si queremos que un dato pueda ser nulo: 
                $table->string('description', 255)->nullable();

            Algunos tipos de datos distintos a los usados:
                $table->boolean('done');
                $table->bigInteger('example);

            El siguiente es un entero pero no puede ser negativo
                $table->unsignedInteger('example');
                $table->unsignedBigInteger('example');
                $table->text('example');
                $table->float('example');
                $table->double('example');

            Enumerados
                $table->enum('state', ['DRAFT', 'PUBLISHED', 'DELETED']);
            */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
