<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('d_o_b')->after('password')->nullable();
            $table->string('phone')->after('d_o_b')->nullable();
            $table->string('address')->after('phone')->nullable();
            $table->string('avatar')->after('address')->nullable();
            $table->text('about_me')->after('avatar')->nullable();
            $table->integer('status')->after('about_me')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('d_o_b');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('avatar');
            $table->dropColumn('about_me');
            $table->dropColumn('status');
        });
    }
}
