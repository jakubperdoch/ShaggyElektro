<?php

define('DB_CONNECTION', 'mysql');
define('DB_HOST', 'localhost');
define('DB_DATABASE', 'ELEKTROSLOVAK');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_CHARSET', 'utf8');

try {
  $DB = new PDO(DB_CONNECTION . ":host=" . DB_HOST . ";dbname=" . DB_DATABASE . ";charset=" . DB_CHARSET, DB_USERNAME, DB_PASSWORD);
  $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
