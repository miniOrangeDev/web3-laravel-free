<?php

use Illuminate\Database\Migrations\Migration;

class MoLaravelweb3PreMigrateFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $src = dirname(__DIR__) .'/includes/js/main.js';
        $dst = public_path() . "/miniorange/sso/includes/js/main.js";
        copy($src, $dst);
        $src = dirname(__DIR__) .'/includes/js/web3-login.js';
        $dst = public_path() . "/miniorange/sso/includes/js/web3-login.js";
        copy($src, $dst);
        $src = dirname(__DIR__) .'/includes/js/web3-modal.js';
        $dst = public_path() . "/miniorange/sso/includes/js/web3-modal.js";
        copy($src, $dst);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
