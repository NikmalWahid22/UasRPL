<?php
require_once BASE_PATH . '/app/models/User.php';
require_once BASE_PATH . '/app/models/Admin.php';

class AuthController {

  public function login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        unset($_SESSION['admin'], $_SESSION['user']);

        $email    = trim($_POST['email']);
        $password = $_POST['password'];

        $admin = (new Admin())->login($email, $password);
        if ($admin) {
            $_SESSION['admin'] = $admin;
            header("Location: " . BASE_URL . "/admin");
            exit;
        }

        $user = (new User())->login($email, $password);
        if ($user) {
            $_SESSION['user'] = $user;
            header("Location: " . BASE_URL . "/user");
            exit;
        }

        $_SESSION['error'] = "Email atau password salah";
        header("Location: " . BASE_URL . "/login");
        exit;
    }

    require_once BASE_PATH . '/app/views/auth/login.php';
}


    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (empty($_POST['email']) || empty($_POST['password'])) {
                $error = "Data tidak lengkap";
            } else {
                (new User())->register($_POST);
                header("Location: " . BASE_URL . "/login");
                exit;
            }
        }

        require_once BASE_PATH . '/app/views/auth/register.php';
    }

    public function logout() {
        $_SESSION = [];
        session_destroy();
        header("Location: " . BASE_URL . "/login");
        exit;
    }

}
