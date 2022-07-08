<?php
$host		= "sql303.ezyro.com";
$user		= "ezyro_32126654";
$pass		= "jqippdd";
$db			= "ezyro_32126654_anis";

$koneksi	= mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
	die("tidak bisa terkoneksi");
}