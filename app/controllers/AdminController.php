<?php
declare(strict_types=1);

class AdminController extends \Phalcon\Mvc\Controller
{
    /**
     * @var Users
     */
    public $user;

    /**
     * @return bool
     */
    public function beforeExecuteRoute()
    {
        if(!$this->session->has('user')) {
            // fix a recursion calling if call /adm/login
            if($this->dispatcher->getActionName() !== 'login') {

                $this->dispatcher->forward([
                    'controller' => 'auth',
                    'action' => 'login',
                ]);

                return false;

            }
        }
        $this->user = $this->session->get('user');
        if (!$this->acl->isAllowed($this->user->role, $this->dispatcher->getControllerName(), $this->dispatcher->getActionName())) {
            $this->dispatcher->forward([
                'controller' => 'errors',
                'action' => 'permission',
            ]);
            return false;
        }
        $this->view->acl = $this->acl;
    }

}

