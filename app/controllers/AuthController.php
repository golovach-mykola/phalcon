<?php
declare(strict_types=1);

class AuthController extends \Phalcon\Mvc\Controller
{

    /**
     * User Login
     */
    public function loginAction()
    {
        $loginForm = new LoginForm();

        if ($this->request->isPost()) {
            if ($loginForm->isValid($this->request->getPost()) != false) {
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');

                $user = Users::findFirst(
                    [
                        'conditions' => 'email = :email:',
                        'bind' => [
                            'email' => $email,
                        ],
                    ]
                );

                if ($user) {
                    $check = $this->security->checkHash($password, $user->password);

                    if (true === $check) {
                        $this->session->set('user', $user);
                        return $this->dispatcher->forward([
                            'controller' => 'users',
                            'action' => 'index',
                        ]);
                    } else {
                        $this->flash->error('Incorrect password');
                    }
                } else {
                    $this->flash->error('User not found');
                }
            } else {
                foreach ($loginForm->getMessages() as $message) {
                    $this->flash->error((string)$message);
                }
            }
        }
        $this->view->form = $loginForm;
    }

    /**
     * User Logout
     */
    public function logoutAction()
    {
        $this->session->destroy();
        return $this->dispatcher->forward(["controller" => "index", "action" => "index"]);
    }

}

