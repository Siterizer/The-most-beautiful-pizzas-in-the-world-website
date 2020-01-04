<?php

require_once 'AppController.php';

class ResetPasswordController extends AppController {

    public function resetPassword()
    {   
		if($this->isPost()){
			$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
			if(empty($email)){
				$this->render('resetPassword', ['messages' => ['Błędny adres e-mail!']]);
				return;
			}
			//
			// Do the stuff
			//
			$this->render('resetPassword', ['messages' => ['Nowe hasło zostało wysłane na podany adres email']]);
			return;
		}
		unset($_SESSION['email']);
        $this->render('resetPassword');
    }
}