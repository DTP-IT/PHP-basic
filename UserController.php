<?php
session_start();
ob_start();
include_once './userModel.php';

class UserController extends User
{
    private $user;
    function __construct()
    {
        $this->user = new User();   
    }

    public function user()
    {
        if (isset($_GET['method'])) {
            $method = $_GET['method'];
        }
        switch($method) {
            case 'register':
                if (isset($_POST['btnRegiser'])) {
                    $checkValidate = true;
                    $name = htmlspecialchars($_POST['name']);
                    $mail = htmlspecialchars($_POST['mail']);
                    $phone = htmlspecialchars($_POST['phone']);
                    $address = htmlspecialchars($_POST['address']);
                    $passwd = htmlspecialchars($_POST['passwd']);
                    $confirmPasswd = htmlspecialchars($_POST['confirmPassword']);
                    $reGexName = "/[^\d]{6,200}/";
                    $reGexMail = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})/";
                    $reGexPhone = "/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/";
                    $reGexPassword = "/[a-zA-Z0-9]{6,100}/";

                    //validate name
                    if (empty($name)) {
                        $checkValidate = false;
                        $_SESSION['errorName'] = 'Vui lòng nhập tên!';
                    } elseif (!preg_match($reGexName, $name)) {
                        $checkValidate = false;
                        $_SESSION['errorName'] = 'Vui lòng nhập đúng định dạng!';
                    } else {
                        $_SESSION['errorName'] = '';
                    }

                    //validate mail
                    if (empty($mail)) {
                        $checkValidate = false;
                        $_SESSION['errorMail'] = 'Vui lòng nhập địa chỉ mail!';
                    } elseif (!preg_match($reGexMail, $mail)) {
                        $checkValidate = false;
                        $_SESSION['errorMail'] = 'Vui lòng nhập đúng định dạng!';
                    } else {
                        $_SESSION['errorMail'] = '';
                    }

                    //validate phone
                    if (empty($phone)) {
                        $_SESSION['errorPhone'] = '';
                    } elseif (!preg_match($reGexPhone, $phone)) {
                        $checkValidate = false;
                        $_SESSION['errorPhone'] = 'Vui lòng nhập đúng định dạng!';
                    } else {
                        $_SESSION['errorPhone'] = '';
                    }

                    //validate address
                    if (empty($address)) {
                        $checkValidate = false;
                        $_SESSION['errorAddress'] = 'Vui lòng nhập địa chỉ!';
                    } else {
                        $_SESSION['errorAddress'] = '';
                    }

                    //validate password
                    if (empty($passwd)) {
                        $checkValidate = false;
                        $_SESSION['errorPasswd'] = 'Vui lòng nhập mật khẩu!';
                    } elseif (!preg_match($reGexPassword, $passwd)) {
                        $checkValidate = false;
                        $_SESSION['errorPasswd'] = 'Vui lòng nhập đúng định dạng!';
                    } else {
                        $_SESSION['errorPasswd'] = '';
                    }

                    //confirm password
                    if (empty($confirmPasswd)) {
                        $checkValidate = false;
                        $_SESSION['errorConfirmPasswd'] = 'Vui lòng nhập lại mật khẩu!';
                    }  elseif ($confirmPasswd != $passwd) {
                        $checkValidate = false;
                        $_SESSION['errorConfirmPasswd'] = 'Mật khẩu không trùng khớp!';
                    } else {
                        $_SESSION['errorConfirmPasswd'] = '';
                    }

                    // register account
                    // nếu biến check = true thì thực hiện đăng ký
                    if ($checkValidate) {
                        session_unset();
                        $result = $this->user->register($name, $passwd, $phone, $mail, $address);

                        if ($result) {
                            header('location: LoginPdo.php'); //Đăng ký thành công sẽ chuyển đến trang đăng nhập
                        } else {
                            $_SESSION['errorRegister'] = "Đăng ký thất bại";
                            include_once './RegisterPdo.php'; //Đăng ký thất bại sẽ thông báo thất bại tại trang đăng ký
                        }
                    } else {
                        include_once './RegisterPdo.php'; // Nếu biến check = false thì báo lỗi ở trang đăng ký
                    }
                } else {
                    session_unset();
                    include_once './RegisterPdo.php';
                }
                break;
            case 'create':
                $this->user->createTableUser(); //http://localhost:8080/?method=create : tạo bảng users
                break;
            case 'view':
                $listUser = $this->user->listUser(); //http://localhost:8080/?method=view : xem danh sách tài khoản
                echo "<pre>";
                print_r($listUser);
                echo "</pre>";
                break;
            case 'drop':
                $this->user->dropUser(); //http://localhost:8080/?method=drop : xóa bảng users
                break;
            case 'login':
                if (isset($_POST['btnLogin'])) {
                    $checkedValidateLogin = true;
                    $loginMail = htmlspecialchars($_POST['loginMail']);
                    $loginPasswd = htmlspecialchars($_POST['loginPasswd']);
                    $remember = htmlspecialchars($_POST['remember']);
                    $reGexMail = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})/";
                    $reGexPassword = "/[a-zA-Z0-9]{6,100}/";

                    //validate mail
                    if (empty($loginMail)) {
                        $checkedValidateLogin = false;
                        $_SESSION['errorLoginMail'] = 'Vui lòng nhập địa chỉ mail!';
                    } elseif (!preg_match($reGexMail, $loginMail)) {
                        $checkedValidateLogin = false;
                        $_SESSION['errorLoginMail'] = 'Vui lòng nhập đúng định dạng!';
                    } else {
                        $_SESSION['errorLoginMail'] = '';
                    }

                    //validate password
                    if (empty($loginPasswd)) {
                        $checkedValidateLogin = false;
                        $_SESSION['errorLoginPasswd'] = 'Vui lòng nhập mật khẩu!';
                    } elseif (!preg_match($reGexPassword, $loginPasswd)) {
                        $checkedValidateLogin = false;
                        $_SESSION['errorLoginPasswd'] = 'Vui lòng nhập đúng định dạng!';
                    } else {
                        $_SESSION['errorLoginPasswd'] = '';
                    }

                    // login
                    if ($checkedValidateLogin) {
                        session_unset();
                        $login = $this->user->login($loginMail, $loginPasswd);
                        /**
                         * Nếu đăng nhập thành công sẽ đặt cookie mail và password trong 1 tuần
                         * Nếu không thành công sẽ báo lỗi
                         */
                        if ($login) {
                            $_SESSION['mail'] = $loginMail;
                            if (!empty($remember)) {
                                setcookie('mail', $loginMail, time() + (86400 * 7), "/"); 
                                setcookie('password', $loginPasswd, time() + (86400 * 7), "/");
                            }
                            header('location: LoginSuccessPdo.php');
                        } else {
                            $_SESSION['errorLogin'] = "Đăng nhập thất bại";
                            include_once './LoginPdo.php';
                        }
                    } else {
                        include_once './LoginPdo.php';
                    }
                } else {
                    session_unset();
                    include_once './LoginPdo.php';
                }
                break;
            case 'logout': 
                unset($_SESSION['mail']); //xóa session['mail]
                setcookie('mail', '', time() - 3600, "/"); //xóa cookie mail
                setcookie('password', '', time() - 3600, "/"); //xóa cookie password
                header('location: LoginPdo.php');
                break;
            default:
                /* 
                 * Nếu tồn tại cookie mail và password sẽ tiến hành đăng nhập:
                 * - Đúng sẽ đặt lại cookie và chuyển sang LoginSuccessPdo.
                 * - Sai sẽ chuyển về LoginPdo và báo lỗi. 
                */
                if (isset($_COOKIE['mail']) && isset($_COOKIE['password'])) {
                    $login = $this->user->login($_COOKIE['mail'], $_COOKIE['password']);
                    if ($login) {
                        $_SESSION['mail'] = $_COOKIE['mail'];
                        //cookie mail, mật khẩu hết hạn sau 1 tuần
                        setcookie('mail', $_COOKIE['mail'], time() + (86400 * 7), "/"); 
                        setcookie('password',$_COOKIE['password'], time() + (86400 * 7), "/");
                        header('location: LoginSuccessPdo.php');
                    } else {
                        $_SESSION['errorLogin'] = "Đăng nhập thất bại";
                        include_once './LoginPdo.php';
                    }
                }
                include_once './LoginPdo.php';
                break;
        }
    }
}

$user = new UserController();
$user->user();