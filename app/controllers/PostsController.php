<?php
declare(strict_types=1);

use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class PostsController extends AdminController
{

    /**
     * Post list
     */
    public function indexAction()
    {
        $currentPage = $this->request->getQuery('page', 'int', 1);
        $paginator   = new PaginatorModel(
            [
                'model'  => Posts::class,
                'limit' => 2,
                'page'  => $currentPage,
            ]
        );

        $page = $paginator->paginate();

        $this->view->setVar('page', $page);
    }

    /**
     * Create post
     */
    public function createAction()
    {
        $postForm = new PostForm(new Posts());

        if ($postForm->validation()) {
            $postForm->save();
            $this->flash->success('Created!');
            return $this->dispatcher->forward([
                'controller' => 'posts',
                'action' => 'index',
            ]);
        } else {
            foreach ($postForm->getMessages() as $message) {
                $this->flash->error((string)$message);
            }
        }

        $this->view->form = $postForm;
    }

    /**
     * Edit Post
     *
     * @param $postId
     */
    public function editAction($postId)
    {
        $post = Posts::findFirst([
            'conditions' => 'id = :id:',
            'bind' => [
                'id' => $postId,
            ],
        ]);
        if (!$post) {
            $this->flash->error('Post not found!');
            return $this->dispatcher->forward([
                'controller' => 'posts',
                'action' => 'index',
            ]);
        }
        $postForm = new PostForm($post);

        if ($postForm->validation()) {
            $postForm->save();
            $this->flash->success('Updated!');
            return $this->dispatcher->forward([
                'controller' => 'posts',
                'action' => 'index',
            ]);
        } else {
            foreach ($postForm->getMessages() as $message) {
                $this->flash->error((string)$message);
            }
        }

        $this->view->post = $post;
        $this->view->form = $postForm;
    }

    /**
     * Delete Post
     *
     * @param $postId
     */
    public function deleteAction($postId)
    {
        $post = Posts::findFirst([
            'conditions' => 'id = :id:',
            'bind' => [
                'id' => $postId,
            ],
        ]);
        if (!$post) {
            $this->flash->error('Post not found!');
            return $this->dispatcher->forward([
                'controller' => 'posts',
                'action' => 'index',
            ]);
        }
        $post->delete();
        $this->flash->success('Deleted!');
        return $this->dispatcher->forward([
            'controller' => 'posts',
            'action' => 'index',
        ]);
    }

}

