<?php

define('DB_NAME', 'user_accounts');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

if (!link)
{
  die('could not connect: ' . mysql_error());
}

$db_selected = mysql_select_db(DB_NAME, $link);

if (!$db_selected)
{
  die('could not use ' . DB_NAME . ': ' .mysql_error());
}

echo 'Connected successfully';
