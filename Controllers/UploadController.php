<?php

require_once 'AppController.php';
require_once __DIR__.'//..//Repository//UploadRepository.php';

class UploadController extends AppController {

    public function upload()
    {   
		if (!$this->isPost()) {
            $this->render('upload');
            return;
        }
        if (isset($_FILES['file'])) {
            $file = $_FILES['file'];
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];
            $file_error = $file['error'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            unset($_POST['title']);
            unset($_POST['description']);
            unset($_FILES);

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));
            $allowed = array('jpg', 'jpeg', 'png');
            if (!in_array($file_ext, $allowed)) {
                $this->render('upload', ['messages' => ['Nieprawidłowy format pliku']]);
                return;
            }
            if (!$file_error === 0) {
                $this->render('upload', ['messages' => ['error, proszę spróbować później']]);
                return;
            }
            if ($file_size > 1048576) {
                $this->render('upload', ['messages' => ['Zbyt duży rozmiar pliku']]);
                return;
            }
            $file_name_new = uniqid('', true) . '.' . $file_ext;
            $file_destination = 'Uploads/' . $file_name_new;

            if (!move_uploaded_file($file_tmp, $file_destination)) {
                $this->render('upload', ['messages' => ['error, proszę spróbować później']]);
                return;
            }
            $uploadRepository = new UploadRepository();
            $uploadRepository->upload($file_name_new, $title, $description);

            $this->render('upload', ['messages' => ['Wkrótce administrator rozważy wysłany post']]);
            return;
        }
    }
}