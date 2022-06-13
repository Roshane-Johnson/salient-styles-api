<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gradients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->nullable(false)
                ->constrained()
                ->onDelete('cascade');
            $table->string("name")->unique()->nullable(false);
            $table->string("colors")->unique()->nullable(false);
            $table->enum("direction", ["to right", "to left", "to top left", "to top right", "to bottom left", "to bottom right", "to top", "to bottom"])->nullable(false)->default("to right");
            $table->boolean('is_favourite')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gradients');
    }
};
