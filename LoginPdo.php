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
      if (isset($_SESSION['errorLogin'])) {
        ?>
  <div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Thông báo:</h4>
    <p></p>
    <p class="mb-0">
      <?php
        echo $_SESSION['errorLogin'];
      }
    ?>
    </p>
  </div>
<div class="container h-100" >
  <div class="row h-100 justify-content-center align-items-center" >
    <div class="col-lg-6 pt-5">
      <h1 class="text-center">Đăng nhập</h1>
      <form action="UserController.php?method=login" method="POST" id="frmLogin">
        <div class="form-group">
          <label for="mail">Mail</label>
          <input type="mail" class="form-control" name="loginMail" id="loginMail" value="<?php if (isset($_POST['loginMail'])) { echo $_POST['loginMail'];}?>"  placeholder="Nhập địa chỉ mail">
          <small id="errorLoginMail" class="form-text text-danger"><?php if (isset($_SESSION['errorLoginMail'])) { echo $_SESSION['errorLoginMail'];}?></small>
        </div>
        <div class="form-group">
          <label for="">Password</label>
          <input type="password" class="form-control" name="loginPasswd" id="loginPasswd"  placeholder="Nhập mật khẩu">
          <small id="errorLoginPasswd" class="form-text text-danger"><?php if (isset($_SESSION['errorLoginPasswd'])) { echo $_SESSION['errorLoginPasswd'];}?></small>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="remember" id="remember" value="remember" checked>
           Remember Me
          </label>
        </div>
        <div class="col text-center">
          <button type="submit" class="btn btn-primary" id="btnLogin" name="btnLogin">Login</button>
          </div>
      </form>
    </div>
  </div>
</div>
</body>
<script>
    $('#frmLogin').on('submit', function() 
    {
      var mail = $('#loginMail').val();
      var passwd = $('#loginPasswd').val();
      var reGexMail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})/;
      var reGexPassword = /[a-zA-Z0-9]{6,100}/;
      if (mail == '') {
        $('#errorLoginMail').html('Vui lòng nhập địa chỉ mail!');

        return false;
      } else {
          if (!reGexMail.test(mail)) {
            $('#errorLoginMail').html('Vui lòng nhập đúng định dạng!');

            return false;
          } else {
              $('#errorLoginMail').html(''); 
            }
        }

      if (passwd == '') {
          $('#errorLoginPasswd').html('Vui lòng nhập mật khẩu!');

          return false;
      } else {
          if (!reGexPassword.test(passwd)) {
            $('#errorLoginPasswd').html('Vui lòng nhập đúng định dạng!');

              return false;
          } else {
            $('#errorLoginPasswd').html(''); 
            }
        }

      return true;
    });
</script>
</html>