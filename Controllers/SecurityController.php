<?php

require_once 'AppController.php';
require_once __DIR__.'//..//Model//User.php';
require_once __DIR__.'//..//Repository//UserRepository.php';

class SecurityController extends AppController {

    public function login()
    {
		if (!$this->isPost()) {
            unset($_POST['userName']);
            unset($_POST['password']);
            $this->render('login');
            return;
        }
        $userName = $_POST['userName'];
        $password = $_POST['password'];
       // $zmienna = password_hash($password, PASSWORD_DEFAULT);
        $userRepository = new UserRepository();
        $user = $userRepository->getUser($userName);
        if (!$user) {
            $this->render('login', ['messages' => ['User with this userName not exist!']]);
            return;
        }
        if (!password_verify($password, $user->getPassword())) {
            $this->render('login', ['messages' => ['Wrong password!']]);
            return;
        }
        $_SESSION["id"] = $user->getID();
        $_SESSION["role"] = $user->getRole();
        unset($_POST['userName']);
        unset($_POST['password']);
        $url = "http://$_SERVER[HTTP_HOST]/";
        header("Location: {$url}?page=postPage&top");
    }
	
	public function logout()
    {
        session_unset();
        session_destroy();

        $url = "http://$_SERVER[HTTP_HOST]/";
        header("Location: {$url}?page=login");
    }
}