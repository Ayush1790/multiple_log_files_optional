<?php

use Phalcon\MVC\Controller;

// logout controller class
class LogoutController extends Controller
{
    public function indexAction()
    {
        if ($this->cookies->get("isLogin")) {
            $this->cookies->set("user_email", $this->session->get('user_email'), time() - 15 * 86400);
            $this->cookies->set("user_pswd", $this->session->get('user_pswd'), time() - 15 * 86400);
            $this->cookies->set("isLogin", false, time() - 15 * 86400);
            $this->session->destroy();
        }
        $this->response->redirect("index");
    }
}
