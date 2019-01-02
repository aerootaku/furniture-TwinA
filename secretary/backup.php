<?php
define("BACKUP_PATH", "../backup/");

$server_name   = "localhost";
$username      = "root";
$password      = "";
$database_name = "twina";
$date_string   = date("Ymd");

$cmd = "mysqldump --routines -h {$server_name} -u {$username} -p{$password} {$database_name} > " . BACKUP_PATH . "{$date_string}_{$database_name}.sql";

exec($cmd);

?>
<script>alert('Database Successfully Backup')</script>
<script>history.go(-1)</script>

