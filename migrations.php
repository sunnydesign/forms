<?php

use Illuminate\Database\Capsule\Manager as DB;

$migrations['20200201'] = function () {
    $info = "Form templates, form data and form states tables";

    // templates schema
    DB::schema(DB_CONNECTION)->create('templates', function ($table) {
        $table->increments('id');
        $table->uuid('uuid');
        $table->string('name');
        $table->string('state');
        $table->string('type');
        $table->jsonb('data');
        $table->timestampsTz();

    });

    // states schema
    DB::schema(DB_CONNECTION)->create('states', function ($table) {
        $table->increments('id');
        $table->string('name');
    });

    // states data
    DB::connection(DB_CONNECTION)->table('states')->insert([
        ['name' => 'created'],
        ['name' => 'filled'],
        ['name' => 'validated'],
        ['name' => 'verified'],
        ['name' => 'approved'],
        ['name' => 'returned'],
        ['name' => 'rejected']
    ]);

    // forms schema
    DB::schema(DB_CONNECTION)->create('forms', function ($table) {
        $table->increments('id');
        $table->uuid('uuid');
        $table->integer('client_id')->unsigned();
        $table->integer('template_id')->unsigned()->nullable();
        $table->integer('state_id')->unsigned()->nullable();
        $table->foreign('template_id')->references('id')->on('templates')->onDelete('set null');
        $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');
        $table->jsonb('data');
        $table->timestampsTz();
    });

    return $info;
};