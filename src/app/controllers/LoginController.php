<?php

use Phalcon\Mvc\Controller;

// Login Controller class
class LoginController extends Controller
{
    public function indexAction()
    {
        // redirect to view
    }
    public function loginAction()
    {
        $this->view->msg = 0;
        $data = $this->request->getPost();
        if (empty($data['email']) || empty($data['pswd'])) {
            $this->view->msg = 0;
            if (empty($data['email']) && empty($data['pswd'])) {
                $this->logger
                    ->excludeAdapters(['signup'])
                    ->info("email is empty and password is empty");
            } elseif (empty($data['email'])) {
                $this->logger
                    ->excludeAdapters(['signup'])
                    ->info("email is empty ");
            } else {
                $this->logger
                    ->excludeAdapters(['signup'])
                    ->info("password is empty ");
            }
        } else {
            $result = Users::findFirst(array("email=?0 and pswd=?1 ", "bind" => array($data['email'], $data['pswd'])));
            if ($data['pswd'] == $result->pswd && $data['email'] == $result->email) {
                $this->cookies->set("isLogin", true, time() + 86400);
                $this->view->msg = 1;
            } else {
                $this->logger
                    ->excludeAdapters(['signup'])
                    ->info("Wrong emailid or password");
            }
        }
    }
}
