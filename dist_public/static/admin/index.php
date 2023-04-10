<!DOCTYPE html>
<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Oxanium&display=swap" rel="stylesheet">
    <style>
    body, html{
      margin: 0;
    width: 100%;
    height: 100vh;
    background: #ffe;
    color: #004;
    font-family: Oxanium;
    }
    button {
      font-family: Oxanium;
    background: linear-gradient(25deg, #4ac, #002);
    padding: 20px;
    border-radius: 5px;
    border: 2px solid #8888;
    margin: 50px;
    font-size: 32px;
    color: #fff;
    }
    .main{
      position: absolute;
      text-align: center;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    }
  </style>
  </head>
  <body>
    <div class="main">
    <button onclick="launchMeeting()">Conference</button>
    <button onclick="launchSiteConfig()">Configure Website</button>
  </div>
  <script>
    launchMeeting = () => {
      window.location.href = 'https://meet.fowlerautocenter.com/managers'
    }
    launchSiteConfig = () => {
      window.location.href = 'https://admin.staff.fowlerautocenter.com/'
    }
  </script>
  </body>
</html>