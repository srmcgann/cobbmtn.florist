<?
  $user = 'user';
  $pass=explode("\n", file_get_contents('/home/cantelope/plorgpw'))[0];
  $db = 'cobbmtn.new';
  $host = 'localhost';
  $link = mysqli_connect($host, $user, $pass, $db);
?>
