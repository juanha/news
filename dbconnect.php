<?php

include("config.inc.php");
mysql_connect($DBHOST,$DBUSER,$DBPWD);
mysql_select_db($DBNAME);
mysql_query("set names utf8");
?>