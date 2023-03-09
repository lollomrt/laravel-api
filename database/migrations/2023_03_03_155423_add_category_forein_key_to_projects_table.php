<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id') //coincidere
                ->nullable()
                ->after('id');
            $table->foreign('category_id')//coincidere
                ->references('id') //nome colonna di riferimento
                ->on('categories') //quale tabella appartiene
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign('projects_category_id_foreign'); //droppa nella tabella projects la colonna category_id che è la foreign key
                //2 passaggio
                $table->dropColumn('category_id');
        });
    }
};
