<?php error_reporting(0);

require 'vendor/autoload.php';

use Dotenv\Dotenv;
use Src\Config\Database;

$dotenv = (Dotenv::createImmutable(__DIR__))->load();

$db = (new Database())->connect();