<?php
define("APP_DIR", __DIR__);
define("DATA_DIR", "../_assets/data");
define("LIBS_DIR", "../_libs");
define("DB_SETTINGS", [
    'host'=>'localhost',
    'dbname'=>'zg_main',
    'charset'=>'utf8mb4',
    'username'=>'admin',
    'password'=>'temp'
]);
define("DB_OPTIONS",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES=>false
]);
