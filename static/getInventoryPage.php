<?
  header('Content-Type: application/json');
  require('db.php');
  $curPage = $_GET['curPage'];
  $itemsPerPage = 1000;
  $page = mysqli_real_escape_string($link, $curPage) * $itemsPerPage;
  $sql = "SELECT * FROM products LIMIT $page, $itemsPerPage";
  $res = mysqli_query($link, $sql);
  $out = [];
  for($i = 0; $i < mysqli_num_rows($res); ++$i) {
    array_push($out, mysqli_fetch_assoc($res));
  }
  echo json_encode($out);
?>
