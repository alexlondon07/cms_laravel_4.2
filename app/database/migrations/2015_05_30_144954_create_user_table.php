<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user', function(Blueprint $table) {
            $table->increments('id');
            // $table->unsignedInteger('client_id');
            $table->string('profile');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('position');
            $table->string('identification');
            $table->string('email');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('telephone');
            $table->string('cellphone');
            $table->string('enable');
            $table->string('is_contact');
            // Laravel 4.1.26
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('user');
    }

}
