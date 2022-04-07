<!DOCTYPE html>
<html>
  <head>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Langar&display=swap');
      body,html{
        margin: 0;
        height: 100%;
        width: 100%;
        background: #123;
        color: #ff0;
        font-family: 'Langar';
        font-size: 32px;
        text-align: center;
      }
      .main{
        margin-bottom: 200px;
      }
      img{
        margin: 40px;
      }
    </style>
  </head>
  <body>
    <div class="main">
      <br>
      Wedding Boquet<br>
      Dec 19, 2020<br>
    <?
      $fileList = glob('*.JPG');
      foreach($fileList as $filename){
        echo '<img src="' . $filename . '" style="width: 50%;"><br>';
      }
    ?>
    </div>
  </body>
</html>
