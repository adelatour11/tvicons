<?php
// These are your database connection settings.
// You can find them on your server in the file data/config.ini.php
$DBHOST = '127.1.1.0';
$DBPORT = '3307';
$DBNAME = 'root';
$DBUSER = 'Azerty#33';
$DBPASS = 'wt';
$TBLPFX = 'wt_';

// This is the email address of the account you want to change
$EMAIL  = 'sajara.webtrees@gmail.com';

// This is the new password
$PASSWD = 'IgnatusAkiraWiltNeon#26#?2020';

$pdo = new PDO(
  (substr($DBHOST, 0, 1) === '/' ?
    "mysql:unix_socket={$DBHOST};dbname={$DBNAME}" :
    "mysql:host={$DBHOST};dbname={$DBNAME};port={$DBPORT}"
  ), $DBUSER, $DBPASS);
$sql = 'UPDATE `' . $TBLPFX . 'user` SET password = :password WHERE email = :email';
$stmt = $pdo->prepare($sql);
$stmt->execute(array('password' => crypt($PASSWD, ''), 'email' => $EMAIL));
if ($stmt->rowCount() > 0) {
  echo 'SUCCESS - The user account was updated.';
} else {
  echo 'ERROR - The user account was not found or not updated.';
}