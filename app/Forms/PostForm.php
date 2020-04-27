<?php

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\PresenceOf;

class PostForm extends Form
{
    /**
     * @var Posts
     */
    public $post;

    public function initialize(Posts $post)
    {
        $this->post = $post;
        $this->add(
            (new Text('title'))
                ->setFilters(['string','trim'])
                ->addValidators([
                    new PresenceOf(['message' => 'The title is required']),
                ])
                ->setAttribute('class', 'form-control')
                ->setDefault($post->title)
        );

        $this->add(
            (new TextArea('content'))
                ->setFilters(['string','trim'])
                ->addValidator(new PresenceOf(['message' => 'The content is required']))
                ->setAttribute('class', 'form-control')
                ->setDefault($post->content)
        );

    }

    /**
     * @return bool
     */
    public function validation()
    {
        if ($this->request->isPost()) {
            return $this->isValid($this->request->getPost());
        }
        return false;
    }

    /**
     * @return Posts
     */
    public function save()
    {
        $this->post->user_id = $this->session->get('user')->id;
        $this->post->title = $this->request->getPost('title');
        $this->post->content = $this->request->getPost('content');
        $this->post->save();
        return $this->post;
    }
}