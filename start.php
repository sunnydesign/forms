#!/usr/bin/php
<?php

/**
 * Forms Engine for customers and corporates
 */

sleep(1);

require_once __DIR__ . '/vendor/autoload.php';

// Libs
use PhpAmqpLib\Connection\AMQPStreamConnection;
use Kubia\Provider\Forms\Service;
use Kubia\Logger\Logger;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Events\Dispatcher;

// Config
$config = __DIR__ . '/config.php';
$config_env = __DIR__ . '/config.env.php';
if (is_file($config)) {
    require_once $config;
} elseif (is_file($config_env)) {
    require_once $config_env;
}

// DB connection init
$db = new DB();
$db->addConnection([
    "driver"   => DB_DRIVER,
    "host"     => DB_HOST,
    "database" => DB_DATABASE,
    "username" => DB_USER,
    "password" => DB_PASSWORD,
    "schema"   => DB_SCHEMA,
    "strict"   => false
], DB_CONNECTION);
$db->setEventDispatcher(new Dispatcher(new Container()));
$db->setAsGlobal();
$db->bootEloquent();
$db::connection(DB_CONNECTION)->enableQueryLog();

// Migration
include __DIR__ . '/migrate.php';

/**
 * Close connection
 *
 * @param $connection
 */
function cleanup_connection($connection) {
    // Connection might already be closed.
    // Ignoring exceptions.
    try {
        if($connection !== null) {
            $connection->close();
        }
    } catch (\ErrorException $e) {
    }
}

/**
 * Shutdown
 *
 * @param $connection
 */
function shutdown($connection)
{
    //$channel->close();
    $connection->close();
}

/**
 * Loop
 */
$connection = null;
while(true) {
    try {
        // Open connection
        $connection = new AMQPStreamConnection(RMQ_HOST, RMQ_PORT, RMQ_USER, RMQ_PASS, RMQ_VHOST, false, 'AMQPLAIN', null, 'en_US', 3.0, 3.0, null, true, 60);
        register_shutdown_function('shutdown', $connection);

        Logger::stdout('Waiting for messages. To exit press CTRL+C', 'input', RMQ_QUEUE,'forms', 0);

        $provider = new Service();
        $provider->setCommands($connection, RMQ_QUEUE);
        $provider->setResponses($connection, RMQ_QUEUE_OUT);

        $provider->channels->commands->confirm_select();  // change channel mode to confirm mode
        $provider->channels->commands->basic_qos(0, 1, false); // one message in one loop
        $provider->channels->commands->basic_consume(RMQ_QUEUE, '', false, false, false, false, [$provider, 'processingMessage']);

        while ($provider->channels->commands->is_consuming()) {
            $provider->channels->commands->wait(null, true, 0);
            usleep(RMQ_TICK_TIMEOUT);
        }
    } catch (\Exception $e) {
        Logger::stdout($e->getMessage(), 'input', RMQ_QUEUE, 'forms', 1);
        cleanup_connection($connection);
        usleep(RMQ_RECONNECT_TIMEOUT);
    }
}
