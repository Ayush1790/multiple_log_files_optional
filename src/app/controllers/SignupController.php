<?php

use Phalcon\Mvc\Controller;

// sign up controller class
class SignupController extends Controller
{
    public function IndexAction()
    {
        // default login view
    }
    public function registerAction()
    {
        $user = new Users();
        $user->assign(
            $this->request->getPost(),
            [
                'name',
                'email',
                'pswd'
            ]
        );
        $success = $user->save();
        if ($success) {
            // setting the session
            $this->session->set("user_email", $user->email);
            $this->session->set("user_pswd", $user->pswd);
            if ($this->request->getPost('rememberMe') == "on") {
                // setting cookies
                $this->cookies->set("user_email", $this->session->get('user_email'), time() + 15 * 86400);
                $this->cookies->set("user_pswd", $this->session->get('user_pswd'), time() + 15 * 86400);
            } else {
                $this->cookies->set("user_email", $this->session->get('user_email'), time() - 15 * 86400);
                $this->cookies->set("user_pswd", $this->session->get('user_pswd'), time() - 15 * 86400);
            }
            $this->view->message = true;
        } else {
            $msg = "Not Register succesfully due to following reason: <br>" . implode("<br>", $user->getMessages());
            $this->view->message = $msg;
        }
        unset($success);
    }
}
