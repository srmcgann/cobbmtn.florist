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
  $sql = "INSERT INTO $table ( ";
  if($name !== '') $sql .= "name,";
  if($title !== '') $sql .= "title, ";
  if($url !== '') $sql .= "url, ";
  if($logo !== '') $sql .= "logo, ";
  if($showTitle !== '') $sql .= "showTitle, ";
  if($showDescription !== '') $sql .= "showDescription, ";
  if($description !== '') $sql .= "description, ";
  if($photo !== '') $sql .= "photo, ";
  if($department !== '') $sql .= "department, ";
  if($email !== '') $sql .= "email";
  $sql .= ") VALUES (";
  if($name !== '') $sql .= "\"$name\",";
  if($title !== '') $sql .= "\"$title\",";
  if($url !== '') $sql .= ""$url\",";
  if($logo !== '') $sql .= "\"$logo\",";
  if($showTitle !== '') $sql .= "$showTitle,";
  if($showDescription !== '') $sql .= "$showDescription,";
  if($description !== '') $sql .= "\"$description\",";
  if($photo !== '') $sql .= "\"$photo\",";
  if($department !== '') $sql .= "\"$department\",";
  if($email !== '') $sql .= "\"$email\"";
  $sql .= ")";
  mysqli_query($link, $sql);
  echo json_encode($sql);
?>