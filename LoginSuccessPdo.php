<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="./vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <script src="./vendor/twbs/bootstrap/assets/js/vendor/jquery-slim.min.js"></script>
</head>
<body>
<?php
    if (isset($_SESSION['mail'])) {
?>
<div class="container h-100" >
  <div class="row h-100 justify-content-center align-items-center" >
    <div class="col-lg-6 pt-5">
      <h1 class="text-center"> Đăng nhập thành công </h1>
      <form action="UserController.php?method=logout" method="POST" id="frmLogout">
        <div class="col text-center">
          <button type="submit" class="btn btn-primary" id="btnLogout" name="btnLogout">Logout</button>
          </div>
      </form>
    </div>
  </div>
  <?php
    } else {
        header('location: LoginPdo.php');
    }
  ?>
</div>
</body>