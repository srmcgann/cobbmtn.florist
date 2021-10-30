<?
  require('db.php');
  $data = json_decode(file_get_contents('php://input'));
  $table = mysqli_real_escape_string($link, $data->{'category'});
  $name = mysqli_real_escape_string($link, $data->{'name'});
  $title = mysqli_real_escape_string($link, $data->{'title'});
  $url = mysqli_real_escape_string($link, $data->{'url'});
  $logo = mysqli_real_escape_string($link, $data->{'logo'});
  $showTitle = mysqli_real_escape_string($link, $data->{'showTitle'});
  $showDescription = mysqli_real_escape_string($link, $data->{'showDescription'});
  $description = mysqli_real_escape_string($link, $data->{'description'});
  $photo = mysqli_real_escape_string($link, $data->{'photo'});
  $department = mysqli_real_escape_string($link, $data->{'department'});
  $email = mysqli_real_escape_string($link, $data->{'email'});
  $sql = "UPDATE $table SET ";
  if($name !== '') $sql .= "name = \"$name\",";
  if($title !== '') $sql .= "title = \"$title\",";
  if($url !== '') $sql .= "url = \"$url\",";
  if($logo !== '') $sql .= "logo = \"$logo\",";
  if($showTitle !== '') $sql .= "showTitle = $showTitle,";
  if($showDescription !== '') $sql .= "showDescription = $showDescription,";
  if($description !== '') $sql .= "description = \"$description\",";
  if($photo !== '') $sql .= "photo = \"$photo\",";
  if($department !== '') $sql .= "department = \"$department\",";
  if($email !== '') $sql .= "email = \"$email\"";
  $id = mysqli_real_escape_string($link, $data->{'id'});
  mysqli_query($link, $sql);
  echo json_encode($sql);
?>
