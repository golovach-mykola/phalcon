    <form method="post" action="">
        <?= $this->flash->output() ?>
        <div class="form-group">
            <label for="title">Title</label>
            <?= $form->render('title') ?>
          </div>
        <div class="form-group">
            <label for="content">Content</label>
            <?= $form->render('content') ?>
        </div>

        <p><?= $this->tag->submitButton(['Save', 'class' => 'btn btn-primary']) ?></p>
    </form>