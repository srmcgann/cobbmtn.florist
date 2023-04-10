<?
require('db.php');
  for($i=5;$i<61;++$i){
    $name="Wrapped - $" . $i;
    $image="https://jsbot.cantelope.org/uploads/15tPHr.jpg";
    $price=$i.".00";
    $flowerCategory="Wrapped";
    $description="Wrapped";
    $sql='INSERT INTO flowers (price, description, image, enabled, name, flowerCategory) VALUES('.$price.',"'.$description.'","'.$image.'",TRUE,"'.$name.'","'.$flowerCategory.'")';
    mysqli_query($link, $sql);
  }
?>
