<?php
session_start();
if( !$_SESSION["admin"] ) die("未授权");
?>