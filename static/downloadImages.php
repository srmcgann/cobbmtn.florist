<?
  require('db.php');
  $imageFolderName = 'resImages';
  $tableName = 'flowers';
  $imageBaseUrl = 'https://www.cobbmtn.florist';
  mkdir($imageFolderName);
  //array_map( 'unlink', array_filter((array) glob("./$imageFolderName/*") ) );
  $sql = "SELECT * FROM $tableName";
  $res = mysqli_query($link, $sql);
  for($i = 0; $i < mysqli_num_rows($res); ++$i){
    $row = mysqli_fetch_assoc($res);
    if(strpos(strtoupper($name = strtolower(basename($row['image']))), '.PNG') !== false){
      $file = file_get_contents($row['image']);
      file_put_contents("./$imageFolderName/" . $name, $file);
      $id = $row['id'];
      $newName = str_replace('png', 'jpg', $name);
      $sql = "UPDATE $tableName SET image = \"$imageBaseUrl/static/$imageFolderName/$newName\" WHERE id = $id";
      mysqli_query($link, $sql);
    }
  }
  exec("mogrify -format jpg ./$imageFolderName/*.png");
  array_map( 'unlink', array_filter((array) glob("./$imageFolderName/*.png") ) );
  echo "done.\n";
?>
