<?php
use Phalcon\Mvc\Controller;

// dashbord controller class
class DashbordController extends Controller
{
    public function indexAction()
    {
        if (!$this->cookies->has("isLogin")) {
            $this->response->redirect('login'); //if user is not login redirecting to login page
        }
    }
}
