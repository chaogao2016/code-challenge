<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => getenv('DB_DSN'),
    // 'dsn' => 'mysql:host=127.0.0.1;dbname=wpt',
    'username' => getenv('DB_USERNAME'),
    // 'username' => 'wpt',
    'password' => getenv('DB_PASSWORD'),
    // 'password' => 'wptpwd',
    'charset' => 'utf8',

    // Schema cache options (for production environmen t)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
