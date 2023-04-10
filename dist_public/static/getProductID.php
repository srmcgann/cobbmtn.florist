<?
  require('db.php');
  $data = json_decode(file_get_contents('php://input'));
  $flowerCategory = mysqli_real_escape_string($link, $data->{'type'});
  $price = mysqli_real_escape_string($link, $data->{'price'});
  $sql='SELECT * FROM flowers WHERE flowerCategory = "' . $flowerCategory . '" AND price = ' . $price;
  $ret = '';
  if($res = mysqli_query($link, $sql)){
    $row = mysqli_fetch_assoc($res);
    $ret = $row['id'];
  }
  echo json_encode($ret);
?>
