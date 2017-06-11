<?php
$db_host = '127.0.0.1';
$db_name = 'railway';
$db_user = 'root';
$db_password = 'root';
$db_driver = 'mysql';
$db_charset = "utf8";

$pdo_dsn = "{$db_driver}: host = {$db_host}; dbname={$db_name}; charset={$db_charset}";
$pdo_opt = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_BOTH];

?>

