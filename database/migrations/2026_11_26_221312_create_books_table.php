<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('description');
            $table->string('img');
            $table->double('price');
            $table->integer('stock');
            $table->string('isbn');
            $table->integer('publication_year');

            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('category_id');

            $table->timestamps();

            $table->foreign('owner_id')
                ->references('id')->on('users');

            $table->foreign('category_id')
                ->references('id')->on('categories');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
