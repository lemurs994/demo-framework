<?php


namespace App\Controllers;


use App\Helpers\Redirect;
use App\Helpers\Sanitize;
use App\Helpers\Session;
use App\Helpers\Validate;
use App\Libraries\Controller;

class Auth extends Controller
{
    private $error = [];

    public function __construct()
    {
        $this->model('user');
    }

    public function LoginForm($errors = [], $post = [])
    {
            $data = [
                'errors' => $errors,
                'post' => $post
            ];

        $this->view('login/form', $data);
    }

    /**
     *
     */
    public function LoginSubmit()
    {
        // CHECK IF EMAIL VALID
        if(Validate::GeneralEmail($_POST['email'])['result'])
        {
            $email = Sanitize::email($_POST['email']);
        } else {
            $this->error['email_error'] = Validate::GeneralEmail($_POST['email'])['error'];
        }

        // CHECK IF PASSWORD VALID
        if(Validate::Password($_POST['password'])['result'])
        {
            $password = Sanitize::string($_POST['password']);
        } else {
            $this->error['password_error'] = Validate::Password($_POST['password'])['error'];
        }


        if(empty($this->error))
        {
            $result = $this->user->GetUserByEmail($email);

            if($result)
            {
               if(!password_verify($password, $result->password))
               {
                   $this->error['password_error'] = 'password incorrect';

               }
            }
            else
            {
                $this->error['email_error'] = 'email not found';
            }


        }

            if(empty($this->error))
            {
                Session::SetSession($result);
                Redirect::To('/routes');
            }
            else
            {
                $this->LoginForm($this->error, $_POST);
            }

    }

    public function Logout()
    {

    }
}