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
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name','firstname')->nullable($value = true);
            $table->string('lastname')->nullable($value = true);
            $table->string('username');
            $table->dropUnique('users_email_unique');
            $table->unique('username');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('firstname','name');
            $table->dropUnique('users_username_unique');
            $table->unique('email');
            $table->dropColumn(['lastname','username']);
        });
    }
};
