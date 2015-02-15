<?php
require_once('../lib/class.dbconnection.php');
require_once('../lib/class.util.php');
require_once('lib/class.admintasks.php');

$_db = dbConnection::getInstance();
$_ut = util::getInstance($_db);
$_at = adminTasks::getInstance($_db, $_ut);
$_sa = statistics::getInstance($_db, $_ut);