<?php

use Illuminate\Database\Capsule\Manager as DB;

$migrations = [];

include __DIR__ . '/migrations.php';

function execute($id) {
    global $migrations;
    echo 'Executing migration: '.$id.': ';
    try {
        $info = call_user_func($migrations[$id]);

        DB::connection(DB_CONNECTION)->table('migrations')->insertOrIgnore([
            'key' => $id,
            'info' => $info,
            'created_at' => DB::connection(DB_CONNECTION)->raw('now()')
        ]);

        echo $info."\n";
    } catch (Exception $e) {
        echo 'Ошибка: ',  $e->getMessage(), "\n";
    }
}

if (!DB::schema(DB_CONNECTION)->hasTable('migrations')) {
    $info = "Таблица миграций";
    DB::schema(DB_CONNECTION)->create('migrations', function ($table) {
        $table->increments('id');
        $table->string('key')->unique();
        $table->string('info');
        $table->boolean('is_harmful')->default(false);
        $table->timestamps();
    });
}

$options = getopt("n:");

if (empty($options['n'])) {
    foreach ($migrations as $key => $migration) {
        if(stripos($key,'harmful') !== false) {
            throw new \Exception("Migrations consists harmful entries, please, run script manually.");
        }

        $migrated = DB::connection(DB_CONNECTION)->table('migrations')->where('key', $key)->get();

        if ($migrated->isEmpty()){
            execute($key);
        }
    }
} else {
    execute($options['n']);
}