<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="./vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <script src="./vendor/twbs/bootstrap/assets/js/vendor/jquery-slim.min.js"></script>
</head>
<body>
<?php
      if (isset($_SESSION['errorRegister'])) {
        ?>
  <div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Thông báo:</h4>
    <p></p>
    <p class="mb-0">
      <?php
        echo $_SESSION['errorRegister'];
      }
    ?>
    </p>
<div class="container h-100">
  <div class="row h-100 justify-content-center align-items-center">
    <div class="col-lg-6 p-5">
      <h1 class="text-center">Đăng ký tài khoản</h1>
      <form action="UserController.php?method=register" method="POST" id="frmRegister">
        <div class="form-group">
          <label for="name">Name</label><span class="text-danger">*</span>
          <input type="text" class="form-control" name="name" id="name" value="<?php if (isset($_POST['name'])) { echo $_POST['name'];}?>"  placeholder="Nhập tên 6-200 ký tự">
          <small id="errorName" class="form-text text-danger"><?php if (isset($_SESSION['errorName'])) { echo $_SESSION['errorName'];}?></small>
        </div>
        <div class="form-group">
          <label for="mail">Mail</label><span class="text-danger">*</span>
          <input type="mail" class="form-control" name="mail" id="mail" value="<?php if (isset($_POST['mail'])) { echo $_POST['mail'];}?>"  placeholder="Nhập địa chỉ mail">
          <small id="errorMail" class="form-text text-danger"><?php if (isset($_SESSION['errorMail'])) { echo $_SESSION['errorMail'];}?></small>
        </div>
        <div class="form-group">
          <label for="phone">Phone</label>
          <input type="text" class="form-control" name="phone" id="phone" value="<?php if (isset($_POST['phone'])) { echo $_POST['phone'];}?>" placeholder="Nhập số điện thoại 10-20 ký tự">
          <small id="errorPhone" class="form-text text-danger"><?php if (isset($_SESSION['errorPhone'])) { echo $_SESSION['errorPhone'];}?></small>
        </div>
        <div class="form-group">
          <label for="">Address</label><span class="text-danger">*</span>
          <textarea class="form-control" name="address" id="address" rows="3"><?php if (isset($_POST['address'])) { echo $_POST['address'];}?></textarea>
          <small id="errorAddress" class="form-text text-danger"><?php if (isset($_SESSION['errorAddress'])) { echo $_SESSION['errorAddress'];}?></small>
        </div>
        <div class="form-group">
          <label for="">Password</label><span class="text-danger">*</span>
          <input type="password" class="form-control" name="passwd" id="passwd"  placeholder="Mật khẩu 6-100 ký tự">
          <small id="errorPasswd" class="form-text text-danger"><?php if (isset($_SESSION['errorPasswd'])) { echo $_SESSION['errorPasswd'];}?></small>
        </div>
        <div class="form-group">
          <label for="">Confirm password</label><span class="text-danger">*</span>
          <input type="password" class="form-control" name="confirmPassword" id="confirmPassword"  placeholder="Nhập lại mật khẩu">
          <small id="errorConfirmPasswd" class="form-text text-danger"><?php if (isset($_SESSION['errorConfirmPasswd'])) { echo $_SESSION['errorConfirmPasswd'];}?></small>
        </div>
        <div class="col text-center">
          <button type="submit" class="btn btn-primary" id="btnRegiser" name="btnRegiser">Register</button>
          </div>
      </form>
    </div>
  </div>
</div>
<script>
    $('#frmRegister').on('submit', function() 
    {
      var name = $('#name').val();
      var mail = $('#mail').val();
      var phone = $('#phone').val();
      var address = $('#address').val();
      var passwd = $('#passwd').val();
      var confirmPasswd = $('#confirmPassword').val();

      var reGexName = /[^/d]{6,200}/;
      var reGexMail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})/;
      var reGexPhone = /^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/;
      var reGexPassword = /[a-zA-Z0-9]{6,100}/;

      if (name == '') {
          $('#errorName').html('Vui lòng nhập tên!');

          return false;
      } else {
          if (!reGexName.test(name)) {
            $('#errorName').html('Vui lòng nhập đúng định dạng!');

              return false;
          } else {
            $('#errorName').html(''); 
            }
        }

      if (mail == '') {
        $('#errorMail').html('Vui lòng nhập địa chỉ mail!');

        return false;
      } else {
          if (!reGexMail.test(mail)) {
            $('#errorMail').html('Vui lòng nhập đúng định dạng!');

            return false;
          } else {
              $('#errorMail').html(''); 
            }
        }

      if (!reGexPhone.test(phone)) {
        $('#errorPhone').html('Vui lòng nhập đúng định dạng!');

        return false;
      } else {
          $('#errorPhone').html(''); 
        }
      
      if (address == '') {
        $('#errorAddress').html('Vui lòng nhập địa chỉ!');

        return false;
      } else {
        $('#errorAddress').html('');
      }

      if (passwd == '') {
          $('#errorPasswd').html('Vui lòng nhập mật khẩu!');

          return false;
      } else {
          if (!reGexPassword.test(passwd)) {
            $('#errorPasswd').html('Vui lòng nhập đúng định dạng!');

              return false;
          } else {
            $('#errorPasswd').html(''); 
            }
        }

        if (confirmPasswd == '') {
          $('#errorConfirmPasswd').html('Vui lòng nhập lại mật khẩu!');

          return false;
      } else {
          if (confirmPasswd != passwd) {
            $('#errorConfirmPasswd').html('Mật khẩu không trùng khớp. Vui lòng nhập lại!');

              return false;
          } else {
            $('#errorConfirmPasswd').html(''); 
            }
        }
      return true;
    });
</script>
</body>
</html>