<?
  require('db.php');
  $data = json_decode(file_get_contents('php://input'));
  $id = mysqli_real_escape_string($link, $data->{'id'});
  $table = mysqli_real_escape_string($link, $data->{'category'});
  $sql = "DELETE FROM $table WHERE id = $id";
  mysqli_query($link, $sql);
  echo json_encode($sql);
?>
